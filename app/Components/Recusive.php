<?php

namespace App\Components;

class Recusive
{
  private $htmlSelect = '';
  private $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function checkCategoryParent($id = 0, $text = '')
  {
    foreach ($this->data as $value) {
      if ($value['parent_id'] == $id) {
        $this->htmlSelect .=  '<option value="' . $value['id'] . '">' . $text . ' ' . $value['name'] . '</option>';
        $this->checkCategoryParent($value['id'], '-');
      }
    }

    return $this->htmlSelect;
  }
}
