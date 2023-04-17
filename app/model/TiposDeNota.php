<?php

class TiposDeNota extends TRecord
{
    const TABLENAME  = 'tipos_de_nota';
    const PRIMARYKEY = 'id_tipo_nota';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_de_nota');
            
    }

    /**
     * Method getAnotacoess
     */
    public function getAnotacoess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id_tipo_nota', '=', $this->id_tipo_nota));
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
    
        $values = Anotacoes::where('id_tipo_nota', '=', $this->id_tipo_nota)->getIndexedArray('id_projetos','{projetos->id_projetos}');
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
    
        $values = Anotacoes::where('id_tipo_nota', '=', $this->id_tipo_nota)->getIndexedArray('id_tipo_nota','{tipo_nota->id_tipo_nota}');
        return implode(', ', $values);
    }

    
}

