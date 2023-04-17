<?php

class Projetos extends TRecord
{
    const TABLENAME  = 'projetos';
    const PRIMARYKEY = 'id_projetos';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $cliente;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('referencia');
        parent::addAttribute('nome_do_evento');
        parent::addAttribute('data_do_evento');
        parent::addAttribute('descricao_do_evento');
        parent::addAttribute('entrada_via_web');
        parent::addAttribute('data_montagem');
        parent::addAttribute('data_desmotagem');
        parent::addAttribute('id_cliente');
            
    }

    /**
     * Method set_clientes
     * Sample of usage: $var->clientes = $object;
     * @param $object Instance of Clientes
     */
    public function set_cliente(Clientes $object)
    {
        $this->cliente = $object;
        $this->id_cliente = $object->id_cliente;
    }

    /**
     * Method get_cliente
     * Sample of usage: $var->cliente->attribute;
     * @returns Clientes instance
     */
    public function get_cliente()
    {
    
        // loads the associated object
        if (empty($this->cliente))
            $this->cliente = new Clientes($this->id_cliente);
    
        // returns the associated object
        return $this->cliente;
    }

    /**
     * Method getAnotacoess
     */
    public function getAnotacoess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id_projetos', '=', $this->id_projetos));
        return Anotacoes::getObjects( $criteria );
    }

    public function set_anotacoes_projetos_to_string($anotacoes_projetos_to_string)
    {
        if(is_array($anotacoes_projetos_to_string))
        {
            $values = Projetos::where('id_projetos', 'in', $anotacoes_projetos_to_string)->getIndexedArray('id_projetos', 'id_projetos');
            $this->anotacoes_projetos_to_string = implode(', ', $values);
        }
        else
        {
            $this->anotacoes_projetos_to_string = $anotacoes_projetos_to_string;
        }

        $this->vdata['anotacoes_projetos_to_string'] = $this->anotacoes_projetos_to_string;
    }

    public function get_anotacoes_projetos_to_string()
    {
        if(!empty($this->anotacoes_projetos_to_string))
        {
            return $this->anotacoes_projetos_to_string;
        }
    
        $values = Anotacoes::where('id_projetos', '=', $this->id_projetos)->getIndexedArray('id_projetos','{projetos->id_projetos}');
        return implode(', ', $values);
    }

    public function set_anotacoes_tipo_nota_to_string($anotacoes_tipo_nota_to_string)
    {
        if(is_array($anotacoes_tipo_nota_to_string))
        {
            $values = TiposDeNota::where('id_tipo_nota', 'in', $anotacoes_tipo_nota_to_string)->getIndexedArray('id_tipo_nota', 'id_tipo_nota');
            $this->anotacoes_tipo_nota_to_string = implode(', ', $values);
        }
        else
        {
            $this->anotacoes_tipo_nota_to_string = $anotacoes_tipo_nota_to_string;
        }

        $this->vdata['anotacoes_tipo_nota_to_string'] = $this->anotacoes_tipo_nota_to_string;
    }

    public function get_anotacoes_tipo_nota_to_string()
    {
        if(!empty($this->anotacoes_tipo_nota_to_string))
        {
            return $this->anotacoes_tipo_nota_to_string;
        }
    
        $values = Anotacoes::where('id_projetos', '=', $this->id_projetos)->getIndexedArray('id_tipo_nota','{tipo_nota->id_tipo_nota}');
        return implode(', ', $values);
    }

    
}

