<?php

namespace PHPProceda\EDI;

class Interpreter {

  private $__arrCodeConfig = array(
     '000' => array(
       'header' => array(
         'remetente' => [3, 35],
         'destinatario' => [38, 35],
         'data' => [73, 6],
         'hora' => [79, 4],
         'arquivo' => [83, 12],
       ),
     ),
     307 => array(
       'dados_complementares_nf' => array(
         'tipo_periodo_entrega' => [3, 1],
         'data_inicial' => [4, 8],
         'hora_inicial' => [12, 4],
         'data_final' => [16, 8],
         'hora_final' => [24, 4],
         'natureza' => [28, 1],
         'obs' => [68, 40],
         'pedido' => [108, 20],
         'referencia_entrega' => [144, 96],
       )
     ),
     308 => array(
       'dados_complementares' => array(
         'email' => [3, 50],
       )
     ),
     310 => array(
       'identificador_documento' => array(
         'id_documento' => [3, 14],
       )
     ),
     311 => array(
       'remetente' => array(
         'cgc' => [3, 14],
         'inscricao_estadual' => [15, 17],
         'endereco' => [32, 40],
         'cidade' => [72, 35],
         'cep' => [107, 9],
         'uf' => [116, 9],
         'dt_embarque' => [125, 8],
         'razao_social' => [133, 40],
       )
     ),
     312 => array(
       'destinatario' =>array (
         'razao_social' => [3, 40],
         'cnpj' => [43, 14],
         'inscricao_estadual' => [57, 15],
         'endereco' => [72, 40],
         'bairro' => [112, 20],
         'cidade' => [132, 35],
         'cep' => [167, 9],
         'cod_municipio' => [176, 9],
         'uf' => [185, 9],
         'area_frete' => [194, 4],
         'p_fone_res' => [198, 35],
         'identificacao_destinatario' => [233, 1],
         'marca' => [234, 4],
       )
     ),
     313 => array(
       'nota_fiscal' => array(
         'num_romaneio' => [3, 15],
         'cod_rota' => [18, 7],
         'meio_transporte' => [25, 1],
         'tipo_transporte' => [26, 1],
         'tipo_carga' => [27, 1],
         'condicao_frete' => [28, 1],
         'serie_nf' => [29, 3],
         'numero_nf' => [32, 8],
         'dt_emissao' => [40, 8],
         'natureza_tipo' => [48, 15],
         'especie_acondicionamento' => [63, 15],
         'qtd_volumes' => [78, 5],
         'valor_nota' => [85, 13],
         'peso_total' => [100, 5],
         'peso_densidade_cubagem' => [107, 3],
       )
     ),
     314 => array(
       'mercadoria' => array(
         'quantidade_volumes' => [3, 5],
         'especie_acondicionamento' => [10, 15],
         'mercadoria_nf' => [25, 30],
         'quantidade_volumes' => [55, 5],
         'especie_acondicionamento_2' => [62, 15],
         'mercadoria' => [77, 30],
         'quantidade_volumes_2' => [107, 5],
         'especie_acondicionamento_3' => [114, 15],
       )
     ),
     317 => array(
       'responsavel_frete' => array(
         'razao_social' => [3, 40],
         'cgc' => [43, 14],
         'inscricao_estadual' => [57, 15],
         'endereco' => [72, 40],
         'bairro' => [112, 20],
         'cidade' => [132, 35],
         'cep' => [167, 9],
         'cod_municipio' => [176, 9],
         'subentidade_pais' => [185, 9],
         'numero_comunicacao' => [194, 35],
       )
     ),
     319 => array(
       'volumes' => array(
         'carga' => [3, 20],
         'peso' => [22, 7],
         'peso_aferido' => [30, 7],
         'peso_cubado' => [37, 7],
         'comprimento' => [44, 7],
         'largura' => [51, 7],
         'altura' => [58, 7],
         'codigo_barras' => [65, 40],
         'canal_venda' => [105, 4],
         'chave_acesso_nfe' => [129, 44],
       )
     ),
     333 => array(
       'dados_complementares_nf' => array(
         'codigo' => [3, 4],
         'tipo_periodo' => [7, 1],
         'dt_inicial_entrega' => [8, 8],
         'hr_inicial_entrega' => [16, 4],
         'dt_final_entrega' => [20, 8],
         'hr_final_entrega' => [28, 4],
         'local_desembarque' => [32, 15],
         'calculo_frete_diferenciado' => [47, 1],
         'identificacao_tabela_frete' => [48, 10],
         // dados entrega casada (outras nf 1)
         'cgc_emissor_nf_a_ser_entregue' => [58, 15],
         'serie_nf' => [73, 3],
         'nf' => [76, 8],
         // dados entrega casada (outras nf 2)
         'cgc_emissor_nf_a_ser_entregue_2' => [84, 15],
         'serie_nf_2' => [99, 3],
         'nf_2' => [102, 8],
         // dados entrega casada (outras nf 3)
         'cgc_emissor_nf_a_ser_entregue_3' => [110, 15],
         'serie_nf_3' => [125, 3],
         'nf_3' => [128, 8],
       )
     )
  );

  public function processLine($line)
  {
      $code = substr($line, 0, 3);
      if (isset($this->__arrCodeConfig[$code])) {
        $notfisArgs = $this->__arrCodeConfig[$code];
        return $this->extract($line, $notfisArgs);
      } else {
        return false;
      }
  }

  /**
   * Extrai em um array as diversas posições de uma linha
   * */
  protected function extract($line, $args)
  {
      $data = [];

      foreach ( $args as $item => $composition ) {
          foreach($composition as $index => $pos) {
            $data[$item][$index] = trim(substr($line, $pos[0], $pos[1]));
          }
      }

      return $data;
  }

}
