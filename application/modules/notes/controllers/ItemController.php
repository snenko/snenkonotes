<?php

class Notes_ItemController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->headScript()->appendFile('http://code.jquery.com/jquery-latest.min.js');
        $this->view->headScript()->appendFile('/js/main.js');

        // action body
        $q = Doctrine_Query::create()
            ->from('Snenkonotes_Model_Notes i');
        $result = $q->fetchArray();
        $this->view->records = $result;

        $form = new Snenkonotes_Form_ItemCreate();
        $this->view->form = $form;
    }

    public function createAction()
    {
        $form = new Snenkonotes_Form_ItemCreate();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $item = new Snenkonotes_Form_ItemCreate();
                $item->fromArray($form->getValues());

                try {
                    $item->save();
                } catch(Exception $e){
                    echo $e->getMessage();
                }

                $id = $item->id;//$id = $item->RecordID;
                $this->_helper->getHelper('FlashMessenger')->addMessage('Ваш запис був добавлений пунктом #' . $id );
                $this->_redirect('/notes/item/success');
            }
        }
    }

    public function successAction()
    {
        if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
            $this->view->messages = $this->_helper->getHelper('FlashMessenger')->getMessages();
        } else {
            $this->_redirect('/');
        }
    }


}





