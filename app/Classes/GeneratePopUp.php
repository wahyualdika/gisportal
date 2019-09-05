<?php
namespace App\Classes;

use App\PopUpLayer;
use File;


class GeneratePopUp{
    public function generatePopUp(){
      $counter = 0;
      $destination = 'C:/xampp/htdocs/cmv/viewer/js/config/identify.js';
      $idLayer = PopUpLayer::all();
      $header_content  = File::get('C:/xampp/htdocs/gisportal_baru/viewer-content/popUp-header-content.txt');
      $footer_content = File::get('C:/xampp/htdocs/gisportal_baru/viewer-content/popUp-footer-content.txt');

      file_put_contents($destination, $header_content);

      foreach( $idLayer as $id ) {
        $fields  = $id->fields;
        $aliases = $id->aliases;
          file_put_contents($destination,
          "'$id->id_layer':{
              '$id->sub_layer':{
                fieldInfos: [",FILE_APPEND);

      foreach( $fields as $key => $field ) {
        if(current($aliases) == null){
           current($aliases) == $field;
        }
          file_put_contents($destination,
            "{
             visible: true,".
            "fieldName:'".$field."',".
            "label:'".current($aliases)."',".
           "},"
        ,FILE_APPEND);
        next($aliases);
      }

      file_put_contents($destination,
      "],
      mediaInfos: [{
                        title: '',
                        caption: '',
                        type: 'image',
                        value: {
                            sourceURL: 'http://localhost/gisportal_baru/public/storage/authentication/img/webgis/$id->id_layer/{".$field."}.jpg',".
                            "linkURL: 'http://localhost/gisportal_baru/public/storage/authentication/img/webgis/$id->id_layer/{".$field."}.jpg',".
                        "}
                    }]
        }
          },",FILE_APPEND);

      }

      file_put_contents($destination, $footer_content,FILE_APPEND);
    }
}
