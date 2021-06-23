<?php

namespace Database\Seeders;

use App\Models\PlanAccount;
use Illuminate\Database\Seeder;

class PlanAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanAccount::create(
            [
                'cod' => '3.1', 'title' => 'Custo De Construção De Imóveis',
                'children' => [
                    [
                        'cod' => '3.1.1', 'title' => 'Custos Diretos',
                        'children' => [
                            ['cod' => '3.1.1.01', 'type' => 'CV', 'title' => 'Materiais Diretos'],
                            ['cod' => '3.1.1.02', 'type' => 'CV', 'title' => 'Ordenados e Salários a Pagar'],
                            ['cod' => '3.1.1.03', 'type' => 'CV', 'title' => 'Salário Extraordinário'],
                            ['cod' => '3.1.1.04', 'type' => 'CV', 'title' => 'Salário Noturno'],
                            ['cod' => '3.1.1.05', 'type' => 'CV', 'title' => 'Adicionais (Insalubridade/Periculosidade/Turno)'],
                            ['cod' => '3.1.1.06', 'type' => 'CV', 'title' => 'Descanso Semanal Remunerado'],
                            ['cod' => '3.1.1.07', 'type' => 'CV', 'title' => 'Salário Família'],
                            ['cod' => '3.1.1.08', 'type' => 'CV', 'title' => 'Pró-Labore'],
                            ['cod' => '3.1.1.09', 'type' => 'CV', 'title' => '13º - Provisão'],
                            ['cod' => '3.1.1.10', 'type' => 'CV', 'title' => 'Férias - Provisão'],
                            ['cod' => '3.1.1.11', 'type' => 'CV', 'title' => 'IRRF s/ Folha'],
                            ['cod' => '3.1.1.12', 'type' => 'CV', 'title' => 'INSS'],
                            ['cod' => '3.1.1.13', 'type' => 'CV', 'title' => 'FGTS'],
                            ['cod' => '3.1.1.14', 'type' => 'CV', 'title' => 'Rescisões'],
                            ['cod' => '3.1.1.15', 'type' => 'CV', 'title' => 'Aviso Prévio'],
                            ['cod' => '3.1.1.16', 'type' => 'CV', 'title' => 'Ajudas de Custo'],
                            ['cod' => '3.1.1.17', 'type' => 'CV', 'title' => 'Seguro de Acidente de Trabalho (inclusive externo)'],
                            ['cod' => '3.1.1.18', 'type' => 'CV', 'title' => 'Provisão para Abono Salarial'],
                            ['cod' => '3.1.1.19', 'type' => 'CV', 'title' => 'Indenizações Trabalhistas'],
                            ['cod' => '3.1.1.20', 'type' => 'CV', 'title' => 'Auxílio Saúde'],
                            ['cod' => '3.1.1.21', 'type' => 'CV', 'title' => 'Operação de Equipamentos'],
                            ['cod' => '3.1.1.22', 'type' => 'CV', 'title' => 'Subempreitadas'],
                            ['cod' => '3.1.1.99', 'type' => 'CV', 'title' => 'Outros Custos Diretos'],
                        ],
                    ],
                    [
                        'cod' => '3.1.2', 'title' => 'Custos Indiretos',
                        'children' => [
                            ['cod' => '3.1.2.01', 'type' => 'CF', 'title' => 'Material Indireto'],
                            ['cod' => '3.1.2.02', 'type' => 'CF', 'title' => 'Mão-de-obra Indireta'],
                            ['cod' => '3.1.2.03', 'type' => 'CF', 'title' => 'Consumo de Água'],
                            ['cod' => '3.1.2.04', 'type' => 'CF', 'title' => 'Consumo de Energia'],
                            ['cod' => '3.1.2.05', 'type' => 'CF', 'title' => 'Comunicações'],
                            ['cod' => '3.1.2.99', 'type' => 'CF', 'title' => 'Outros Custos Indiretos'],
                        ],
                    ],
                ],
            ]
        );
        PlanAccount::create(
            [
                'cod' => '4.1', 'title' => 'Deduções da Receita',
                'children' => [
                    [
                        'cod' => '4.1.1', 'title' => 'Imposto sobre Serviços',
                        'children' => [
                            ['cod' => '4.1.1.01', 'type' => 'DV', 'title' => 'ISS sobre Construções'],
                            ['cod' => '4.1.1.02', 'type' => 'DV', 'title' => 'ISS sobre Administração de Imóveis'],
                        ],
                    ],
                    [
                        'cod' => '4.1.2', 'title' => 'PIS',
                        'children' => [
                            ['cod' => '4.1.2.01', 'type' => 'DV', 'title' => 'PIS sobre Venda de Imóveis'],
                            ['cod' => '4.1.2.02', 'type' => 'DV', 'title' => 'PIS sobre Administração de Imóveis'],
                            ['cod' => '4.1.2.03', 'type' => 'DV', 'title' => 'PIS sobre Locações'],
                        ],
                    ],
                    [
                        'title' => '4.1.3 -  Cofins',
                        'children' => [
                            ['cod' => '4.1.3.01', 'type' => 'DV', 'title' => 'Cofins sobre Venda de Imóveis'],
                            ['cod' => '4.1.3.02', 'type' => 'DV', 'title' => 'Cofins sobre Administração de Imóveis'],
                            ['cod' => '4.1.3.03', 'type' => 'DV', 'title' => 'Cofins sobre Locações'],
                        ],
                    ],
                ],
            ]
        );
        PlanAccount::create(
            [
                'cod' => '4.2', 'title' => 'Custo Das Vendas',
                'children' => [
                    [
                        'cod' => '4.2.1', 'title' => 'Custo dos Imóveis Vendidos',
                        'children' => [
                            ['cod' => '4.2.1.01', 'type' => 'CV', 'title' => 'Imóveis Acabados'],
                            ['cod' => '4.2.1.02', 'type' => 'CV', 'title' => 'Imóveis em Construção'],
                        ],
                    ],
                    [
                        'cod' => '4.2.2', 'title' => 'Custo dos Serviços Prestados',
                        'children' => [
                            ['cod' => '4.2.2.01', 'type' => 'CV', 'title' => 'Custo de Administração de Imóveis'],
                            ['cod' => '4.2.2.02', 'type' => 'CV', 'title' => 'Custo de Locação de Imóveis'],
                        ],
                    ],
                ],
            ]
        );
        PlanAccount::create(
            [
                'cod' => '4.3', 'title' => 'Despesas Operacionais',
                'children' => [
                    [
                        'cod' => '4.3.1', 'title' => 'Despesas Administrativas',
                        'children' => [
                            ['cod' => '4.3.1.01', 'type' => 'DF', 'title' => 'Ordenados e Salários a Pagar'],
                            ['cod' => '4.3.1.02', 'type' => 'DF', 'title' => 'Salário Extraordinário'],
                            ['cod' => '4.3.1.03', 'type' => 'DF', 'title' => 'Salário Noturno'],
                            ['cod' => '4.3.1.04', 'type' => 'DF', 'title' => 'Adicionais (Insalubridade/Periculosidade/Turno)'],
                            ['cod' => '4.3.1.05', 'type' => 'DF', 'title' => 'Descanso Semanal Remunerado'],
                            ['cod' => '4.3.1.06', 'type' => 'DF', 'title' => 'Salário Família'],
                            ['cod' => '4.3.1.07', 'type' => 'DF', 'title' => 'Pró-Labore'],
                            ['cod' => '4.3.1.08', 'type' => 'DF', 'title' => '13º - Provisão'],
                            ['cod' => '4.3.1.09', 'type' => 'DF', 'title' => 'Férias - Provisão'],
                            ['cod' => '4.3.1.10', 'type' => 'DF', 'title' => 'IRRF s/ Folha'],
                            ['cod' => '4.3.1.11', 'type' => 'DF', 'title' => 'INSS'],
                            ['cod' => '4.3.1.12', 'type' => 'DF', 'title' => 'FGTS'],
                            ['cod' => '4.3.1.13', 'type' => 'DF', 'title' => 'Rescisões'],
                            ['cod' => '4.3.1.14', 'type' => 'DF', 'title' => 'Aviso Prévio'],
                            ['cod' => '4.3.1.15', 'type' => 'DF', 'title' => 'Ajudas de Custo'],
                            ['cod' => '4.3.1.16', 'type' => 'DF', 'title' => 'Seguro de Acidente de Trabalho (inclusive externo)'],
                            ['cod' => '4.3.1.17', 'type' => 'DF', 'title' => 'Provisão para Abono Salarial'],
                            ['cod' => '4.3.1.18', 'type' => 'DF', 'title' => 'Indenizações Trabalhistas'],
                            ['cod' => '4.3.1.19', 'type' => 'DF', 'title' => 'Auxílio Saúde'],
                            ['cod' => '4.3.1.20', 'type' => 'DF', 'title' => 'Materiais'],
                            ['cod' => '4.3.1.21', 'type' => 'DF', 'title' => 'Água'],
                            ['cod' => '4.3.1.22', 'type' => 'DF', 'title' => 'Eletricidade'],
                            ['cod' => '4.3.1.23', 'type' => 'DF', 'title' => 'Comunicações'],
                            ['cod' => '4.3.1.24', 'type' => 'DF', 'title' => 'Depreciações'],
                            ['cod' => '4.3.1.99', 'type' => 'DF', 'title' => 'Outras Despesas'],
                        ],
                    ],
                    [
                        'title' => '4.3.2 -  Despesas Comerciais',
                        'children' => [
                            ['cod' => '4.3.2.01', 'type' => 'DV', 'title' => 'Materiais'],
                            ['cod' => '4.3.2.02', 'type' => 'DV', 'title' => 'Água'],
                            ['cod' => '4.3.2.03', 'type' => 'DV', 'title' => 'Eletricidade'],
                            ['cod' => '4.3.2.04', 'type' => 'DV', 'title' => 'Comunicações'],
                            ['cod' => '4.3.2.05', 'type' => 'DV', 'title' => 'Publicidade e Propaganda'],
                            ['cod' => '4.3.2.98', 'type' => 'DV', 'title' => 'Comissões s/ Vendas'],
                            ['cod' => '4.3.2.99', 'type' => 'DV', 'title' => 'Outras Despesas'],
                        ],
                    ],
                ]
            ]
        );
        PlanAccount::create(
            [
                'cod' => '4.5', 'title' => 'Impostos e Participações No Lucro',
                'children' => [
                    [
                        'cod' => '4.5.1', 'title' => 'Impostos e Participações no Lucro',
                        'children' => [
                            ['cod' => '4.5.1.01', 'type' => 'DV', 'title' => 'Participações de Empregados'],
                            ['cod' => '4.5.1.02', 'type' => 'DV', 'title' => 'Participações da Diretoria'],
                            ['cod' => '4.5.1.19', 'type' => 'DV', 'title' => 'Contribuição Social s/ Lucro'],
                            ['cod' => '4.5.1.20', 'type' => 'DV', 'title' => 'Imposto de Renda s/ Lucro'],

                        ],
                    ]
                ]
            ]
        );
        PlanAccount::create(
            [
                'cod' => '5.1', 'title' => 'Receita Bruta',
                'children' => [
                    [
                        'cod' => '5.1.1', 'title' => 'Receita de Venda de Imóveis',
                        'children' => [
                            ['cod' => '5.1.1.01', 'type' => 'ROP', 'title' => 'Imóveis Acabados'],
                            ['cod' => '5.1.1.02', 'type' => 'ROP', 'title' => 'Imóveis em Construção'],
                        ],
                    ],
                    [
                        'cod' => '5.1.2', 'title' => 'Receita dos Serviços Prestados',
                        'children' => [
                            ['cod' => '5.1.2.01', 'type' => 'ROP', 'title' => 'Receita de Administração de Imóveis'],
                            ['cod' => '5.1.2.02', 'type' => 'ROP', 'title' => 'Receita de Locação de Imóveis'],
                        ],
                    ],
                ],
            ]
        );
        PlanAccount::create(
            [
                'cod' => '5.3', 'type' => 'RNOP', 'title' => 'Receitas Não Operacionais',
                'children' => [
                    [
                        'cod' => '5.3.1', 'type' => 'RNOP', 'title' => 'Entradas de Caixa Não Operacionais',
                        'children' => [
                            ['cod' => '5.3.1.1', 'type' => 'RNOP', 'title' => 'Recebimento de Empréstimo'],
                            ['cod' => '5.3.1.2', 'type' => 'RNOP', 'title' => 'Integralização de Capital'],
                            ['cod' => '5.3.1.3', 'type' => 'RNOP', 'title' => 'Resgate de Aplicação Financeira'],
                            ['cod' => '5.3.1.4', 'type' => 'RNOP', 'title' => 'Juros Recebidos'],
                            ['cod' => '5.3.1.5', 'type' => 'RNOP', 'title' => 'Venda do Ativo Imobilizado'],
                            ['cod' => '5.3.1.6', 'type' => 'RNOP', 'title' => 'Alienação do Ativo Intágivel'],
                            ['cod' => '5.3.1.7', 'type' => 'RNOP', 'title' => 'Alienação de Investimentos'],
                            ['cod' => '5.3.1.8', 'type' => 'RNOP', 'title' => 'Devolução de Valores Pagos'],
                            ['cod' => '5.3.1.9', 'type' => 'RNOP', 'title' => 'Simples Remessa de Entrada'],
                        ],
                    ]
                ],
                'cod' => '5.4 ', 'type' => 'DNOP', 'title' => 'Despesas Não Operacionais',
                'children' => [
                    [
                        'cod' => '5.4.1 ', 'type' => 'DNOP', 'title' => 'Saídas de Caixa Não Operacionais',
                        'children' => [
                            ['cod' => '5.4.1.01', 'type' => 'DNOP', 'title' => 'Pagamento de Empréstimo'],
                            ['cod' => '5.4.1.02', 'type' => 'DNOP', 'title' => 'Aplicação Financeira'],
                            ['cod' => '5.4.1.03', 'type' => 'DNOP', 'title' => 'Investimento no Imobilizado'],
                            ['cod' => '5.4.1.04', 'type' => 'DNOP', 'title' => 'Investimento no Intangível'],
                            ['cod' => '5.4.1.05', 'type' => 'DNOP', 'title' => 'Retirada do Sócio'],
                            ['cod' => '5.4.1.06', 'type' => 'DNOP', 'title' => 'Parcelamento de Impostos'],
                            ['cod' => '5.4.1.07', 'type' => 'DNOP', 'title' => 'Devolução de Valores Recebidos'],
                            ['cod' => '5.4.1.08', 'type' => 'DNOP', 'title' => 'Doações e Patrocínios'],
                            ['cod' => '5.4.1.09', 'type' => 'DNOP', 'title' => 'Multas de Trânsito'],
                            ['cod' => '5.4.1.10', 'type' => 'DNOP', 'title' => 'Duplicatas Descontadas'],
                            ['cod' => '5.4.1.11', 'type' => 'DNOP', 'title' => 'Taxas Bancárias'],
                            ['cod' => '5.4.1.12', 'type' => 'DNOP', 'title' => 'Juros Passivos'],
                            ['cod' => '5.4.1.13', 'type' => 'DNOP', 'title' => 'Simples Remessa Saída'],
                            ['cod' => '5.4.1.14', 'type' => 'DNOP', 'title' => 'Outras Saídas'],
                            ['cod' => '5.4.1.15', 'type' => 'DNOP', 'title' => 'Retirada autorizada de valores de caixa'],
                        ],
                    ]
                ],
            ]
        );
    }
}
