<?php
namespace App\Classes;

use App\LayerModel;
use File;


class GeneratePopUp{
    public function generatePopUp(){

      $destination = 'C:/xampp/htdocs/cmv/viewer/js/config/identify.js';
      $idLayer = LayerModel::all()->unique('id_layer');
      $header_content  = File::get('C:/xampp/htdocs/gisportal_baru/viewer-content/popUp-header-content.txt');
      $footer_content = File::get('C:/xampp/htdocs/gisportal_baru/viewer-content/popUp-footer-content.txt');

      file_put_contents($destination, $header_content);
      foreach( $idLayer as $id ) {
          file_put_contents($destination,
          $id->id_layer.":{".
              "0:{
                fieldInfos: [{
                    visible: true,
                    fieldName: 'FID',
                    label: 'FID'
                }, {
                    visible: true,
                    fieldName: 'Id',
                    label: 'Id',
                }]
              }
            },"

          ,FILE_APPEND);
      }

      file_put_contents($destination, $footer_content,FILE_APPEND);

      }


}
