<?php
namespace app\forms;

use std, gui, framework, app;
use php\io\File;
use php\lang\Thread;

class MainForm extends AbstractForm
{


    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
         $dir = $this->dirChooser->execute();
            $list = $dir->findFiles();
            $count = count($list);
            $this->label->text = $count;
            $thread = new Thread(function () use ($list){
            foreach ($list as $val){
                    $val_hash = $val->hash('SHA-256');
                    if($val_hash == NULL){
                    
                    }else{
                    $this->table->items->add(['Path' => $val, 'Hash' => $val_hash]);
                    }
                }
                
        });
            $thread->start();
      
         
    }

    

    /**
     * @event table.click 
     */
    function doTableClick(UXMouseEvent $e = null)
    {    
        if($this->table->selectedItem == true){
        $mass = $this->table->selectedItem['Hash'];
        UXClipboard::setText($mass);
         $this->toast('Text is copied successfully!');
        }else{
            
        }
    }


   


}
