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

  public function checkCategoryParent($parentId, $id = 0, $text = '')
  {
    foreach ($this->data as $value) {
      if ($value['parent_id'] == $id) {
        if (!empty($parentId) && $parentId == $value['id']) {
          $this->htmlSelect .=  '<option selected value="' . $value['id'] . '">' . $text . ' ' . $value['name'] . '</option>';
        } else {
          $this->htmlSelect .=  '<option value="' . $value['id'] . '">' . $text . ' ' . $value['name'] . '</option>';
        }
        $this->checkCategoryParent($parentId, $value['id'], '--');
      }
    }

    return $this->htmlSelect;
  }
}
