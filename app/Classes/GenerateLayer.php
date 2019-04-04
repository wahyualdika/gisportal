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
        $fields = $layer->fields;
        $layers = $layer->default_layer;
          if($fields==null){
            $fields = ["*"];
          }

          if($layers==null){
            $layers=["0"];
          }

          if($layer->visible==1){
              $visible = "true";
          }
          else{
             $visible = 'false';
          }


          file_put_contents($destination,
          "
          {
          type: '$layer->type',
          url: '$layer->url',
          title: '$layer->title',
            options: {
                id: '$layer->id_layer',
                opacity: 1.0,
                visible: '$visible',
                outFields: [",FILE_APPEND);

                foreach( $fields as $key => $field ) {
                  file_put_contents($destination,"'".$field."'".",",FILE_APPEND);
                }


          file_put_contents($destination,
                "],
                mode: 0,
                imageParameters: buildImageParameters({
                    layerIds: [",FILE_APPEND);
                    foreach( $layers as $key => $lyr ) {
                      file_put_contents($destination,"'".$lyr."'".",",FILE_APPEND);
                    }
         file_put_contents($destination,
                    "],
                    layerOption: 'show'
                })
            },
            layerControlLayerInfos: {
                layerGroup: '$layer->group'
            }
          },",FILE_APPEND);
        }
        file_put_contents($destination, $footer_content,FILE_APPEND);
    }
  }
