<?php
namespace App\Classes;

use App\LayerModel;
use File;

class GenerateLayer {
    public function generateLayer(){
        $destination = 'C:/xampp/htdocs/cmv/viewer/js/config/viewer.js';
        $header_content  = File::get('C:/xampp/htdocs/gisportal_baru/viewer-content/header-content.txt');
        $footer_content = File::get('C:/xampp/htdocs/gisportal_baru/viewer-content/footer-content.txt');
        file_put_contents($destination, $header_content);

        $layers = LayerModel::all();

        foreach($layers as $layer){
        $value = $layer->fields;
          if($value==null){
            $value = ["*"];
          }

          if($layer->visible==1){
              $visible = "true";
          }
          else{
             $visible = 'false';
          }


          file_put_contents($destination,
          "{
          type: '$layer->type',
          url: '$layer->url',
          title: '$layer->title',
            options: {
                id: '$layer->id_layer',
                opacity: 1.0,
                visible: '$visible',
                outFields: [",FILE_APPEND);

                foreach( $value as $key => $n ) {
                  file_put_contents($destination,"'".$n."'".",",FILE_APPEND);
                }


          file_put_contents($destination,
                "],
                mode: 0,
                imageParameters: buildImageParameters({
                    layerIds: ['$layer->default_layer'],
                    layerOption: 'show'
                })
            }
          },",FILE_APPEND);
        }
        file_put_contents($destination, $footer_content,FILE_APPEND);
    }
  }
