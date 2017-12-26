<?php

Class error404Controller Extends baseController {

public function index() 
{
        $this->registry->template->blog_heading = 'Invalid Page';
        $this->registry->template->show('error404');
}


}
?>
