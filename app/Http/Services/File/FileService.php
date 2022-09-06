<?php

namespace App\Http\Services\File;

use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FileService implements FileServiceInterface
{

    /**
     * Retorna um array com os dados do arquivo
     *
     * @param string $fileName
     * @return array
     */
    public function readFile(string $fileName = ''): array
    {
        $arr = array();
        $fh = fopen($fileName,'r');
        while ($line = fgets($fh)) {
            $arr[] = $this->normalizeLine($line);
        }
        fclose($fh);

        return $arr;
    }

    public function store(array $data): bool
    {
        DB::beginTransaction();
        try {

            foreach ($data as $line) {

                if (!$user = User::whereCpf($line->cpf)->first()) {
                    $user = User::create([
                        'name' => null,
                        'cpf'  => $line->cpf
                    ]);
                }

                if (!$store = Store::whereName($line->store_name)->first()) {
                    $store = Store::create([
                        'name'       => $line->store_name,
                        'owner_name' => $line->owner_name
                    ]);
                }

                $user->Transactions()->attach($store->id, [
                    'value'         => $this->verifyValue($line->value, $line->type),
                    'card_number'   => $line->card,
                    'type'          => $line->type,
                    'date'          => $line->date,
                    'time'          => $line->time
                ]);

            }
            DB::commit();
            return true;
        }
        catch (\Exception $exception){
            DB::rollBack();
            return false;
        }
    }

    /**
     * Retorna um array|obect com os dados da linha normalizados
     *
     * @param string $line
     * @return array|object
     */
    private function normalizeLine(string $line): array|object
    {
        $normalizedline = array();
        $normalizedline['type']         = $this->getTypeName(intval(trim(substr($line, 0, 1))));
        $normalizedline['date']         = date('Y-m-d', strtotime(trim(substr($line, 1, 8))));
        $normalizedline['value']        = floatval(trim(substr($line, 9, 10))) / 100.00;
        $normalizedline['cpf']          = trim(substr($line, 19, 11));
        $normalizedline['card']         = trim(substr($line, 30, 12));
        $normalizedline['time']         = trim(substr($line, 42, 6));
        $normalizedline['owner_name']   = trim(substr($line, 48, 14));
        $normalizedline['store_name']   = trim(substr($line, 62, 19));

        return (object) $normalizedline;
    }

    /**
     * Função para retornar o nome do tipo da transação
     *
     * @param int $number
     * @return string|null
     */
    private function getTypeName(int $number): ?string
    {
        switch ($number){
            case 1: return 'Débito';
            case 2: return 'Boleto';
            case 3:	return 'Financiamento';
            case 4: return 'Crédito';
            case 5: return 'Recebimento Empréstimo';
            case 6: return 'Vendas';
            case 7: return 'Recebimento TED';
            case 8: return 'Recebimento DOC';
            case 9:	return 'Aluguel';
            default: return null;
        }
    }

    /**
     * Função para retornar o valor de acordo com o tipo da transação
     *
     * @param int $number
     * @param string $type
     * @return int
     */
    private function verifyValue(int $number, string $type): int
    {
        if ($type === 'Boleto' || $type === 'Financiamento' || $type === 'Aluguel') return $number * -1;
        return $number;
    }
}
