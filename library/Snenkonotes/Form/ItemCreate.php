<?php

class Snenkonotes_Form_ItemCreate extends Zend_Dojo_Form //Zend_Form//
{
    private $options_notes = array(
        'degrade' => true,
        'label'=>'notes-item-note',
        'class' => 'form-itemcreate',
        'editActionInterval' => 2,
        'focusOnLoad'        => true,
        'height'             => '100px',
        //'min-height'             => '100px',
        'inheritWidth'       => true,
        'plugins'=>
            array(/*'undo','redo', 'selectAll', 'subscript','superscript', '|',*/
                  'foreColor', 'hiliteColor', '|',
                  //'cut','copy','paste','|',
                  'bold','italic','underline','strikethrough','|',
                  'insertOrderedList', 'insertUnorderedList','|',
                  'removeFormat','insertHorizontalRule', 'createLink', '|',

                  'createLink', 'insertImage', '|',
                  'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|',
                  'indent', 'outdent', '|',
                  'viewSource',
                  /*'fontName', 'fontSize', 'formatBlock', '|',*/
                  ),);

    public function init()
    {
        //Zend_Dojo::enableForm($this);

		$this->setAction('/notes/item/create')
			->setMethod('post')
            ->setName('notes_item_create')
            ->setLegend('notes-item-create');

		$mask = new Zend_Form_Element_Text('mask');
		$mask->setLabel('notes-item-mask')
			->addFilter('HtmlEntities')
			->addFilter('StringTrim')
			->setOptions(array('size' => '60'))
			/*->addValidator('Alpha')*/;

		$comment = new Zend_Form_Element_Text('comment');
		$comment->setLabel('notes-item-comments')
			->addFilter('HtmlEntities')
			->addFilter('StringTrim')
            ->setOptions(array('size' =>  '60'))
			/*->setOptions(array('size' => '255', 'width'=>'100%'))*/
			/*->addValidator('Alpha')*/;

        // At instantiation:
        $note = new Zend_Dojo_Form_Element_Editor('note');
        $note->setOptions($this->options_notes)
            ->setRequired(true)
            ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => 'Поле не може бути пустим.')));;

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('submit')
			->setOrder(100)
			->setOptions(array('class' => 'submit'));

		$this->addElement($mask)
			->addElement($comment)
			->addElement($note)
			->addElement($submit);

        $this->addDisplayGroup(array('mask', 'comment','note', 'submit'), 'priority');
        $this->getDisplayGroup('priority')
            ->setOrder(20)
            ->setLegend('form-item-create-priority-legend');
    }
}

