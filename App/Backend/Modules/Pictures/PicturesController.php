<?php 

namespace App\Backend\Modules\Pictures;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \Entity\Pictures;
use \FormBuilder\AdminFormBuilder;
use \CRFram\FormHandler;

class PicturesController extends BackController {


    // create main picture when create new page 

    public function createPictureWithPage($module, $item_id) {

        $picture = new Pictures([

            'alt' => NULL,
            'src' => NULL,
            'item_id' => $item_id

        ]);

        $manager = $this->managers->getManagerOf('Pictures')->createMain($picture, $module);

    }

    // create main picture when create new page 

    public function createSliderWithPage($module, $item_id) {

        $compteur = 10;

        for($i = 1 ; $i <= $compteur ; $i++) {

            $picture = new Pictures([

                'alt' => NULL,
                'src' => NULL,
                'item_id' => $item_id,
                'nb_picture' => $i,
                'picture_name' => 'image ' . $i

            ]);

            $manager = $this->managers->getManagerOf('Pictures')->createSlider($picture, $module);

        }

    }

    // update main picture each time new picture is loaded and saved 

    public function updateMain($module, $item_id, $file, $post) {

        // if main $_POST['add-main-picture'] is empty, then empty main picture in bdd 

        if($post == true) {

            $manager = $this->managers->getManagerOf('Pictures');
            $unique = $manager->getUnique($module, $item_id);

            if(!empty($unique->Src()) && $unique->Src() != NULL) {

                unlink($unique->Src());

            }

            $picture = new Pictures([

                'alt' => NULL,
                'src' => NULL,
                'item_id' => $item_id

            ]);

            $manager->updateMainPicture($picture, $module);

        }
        else {

            // if $_POST['add-main-picture'] not empty the upload file and add in bdd   

            if (isset($file) AND $file['error'] == 0 AND $file['size'] != 0)
            {
                // if there is already something in bdd then unlink file associated 

                $manager = $this->managers->getManagerOf('Pictures');
                $remove = $manager->getUnique($module, $item_id);

               if(!empty($remove->Src()) && $remove->Src() != NULL) {

                    unlink($remove->Src());

                }

                // then upload new file and update bdd 

                // if ($_FILES['monfichier']['size'] <= 1000000)
                // {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($file['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG');
                if (in_array($extension_upload, $extensions_autorisees))
                {

                    // rename file to avoid duplicated file names 

                    $temp = explode(".", $file['name']);
                    $newfilename = mt_rand(10, 1000) . '-' . $item_id . '.' . end($temp);
                    $path = "img/uploads/" . basename($newfilename);
                    move_uploaded_file($file['tmp_name'], $path);

                    // $img = imagecreatefromjpeg("img/uploads/".$newfilename);

                    // imagejpeg($img, "img/uploads/".$newfilename, 50);

                    $picture = new Pictures([

                        'alt' => $module,
                        'src' => $path,
                        'item_id' => $item_id

                    ]);

                    $manager->updateMainPicture($picture, $module);
                    
                }
            } 
        }
    }


    // upload and register new slider

    public function updateSlider($module, $item_id, $pictures, $post) {

        // if user choose slider media 

        if($post['media'] == 'slider') {

            for($i = 1; $i <= 10 ; $i++) {

                // then add in bdd and upload pictures 

                if (isset($pictures['add-slider-' . $i]) AND $pictures['add-slider-' . $i]['error'] == 0)
                {
                    // if ($_FILES['monfichier']['size'] <= 1000000)
                    // {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($pictures['add-slider-' . $i]['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG');
                    if (in_array($extension_upload, $extensions_autorisees))
                    {

                        $temp = explode(".", $pictures['add-slider-' . $i]["name"]);
                        $newfilename = mt_rand(10, 1000) . '-' . $item_id . '.' . end($temp);
                        $path = "img/slider/" . basename($newfilename);
                        move_uploaded_file($pictures['add-slider-' . $i]['tmp_name'], $path);

                        // $img = imagecreatefromjpeg("img/uploads/".$newfilename);

                        // imagejpeg($img, "img/uploads/".$newfilename, 50);


                        $manager = $this->managers->getManagerOf('Pictures');

                        if($pictures['add-slider-' . $i] != NULL) {

                            $unique = $manager->getUniqueSlide($i, $module, $item_id, 'update');

                           if(!empty($unique->Src()) && $unique->Src() != NULL) {

                                unlink($unique->Src());

                            }

                            $picture = new Pictures([

                                'alt' => $unique->Picture_name(),
                                'src' => $path,
                                'item_id' => $item_id,
                                'nb_picture' => $unique->Nb_picture(),
                                'picture_name' => $unique->Picture_name()

                            ]);

                            $manager->updateSlider($picture, $module, $unique->getId());

                        }

                    }

                }

                // if user empties some slides 

                if (isset($post['empty-slider-' . $i]))
                {

                    // then delete slides selected and unlink files associated 

                    $manager = $this->managers->getManagerOf('Pictures');
                    $unique = $manager->getUniqueSlide($post['empty-slider-' . $i], $module, $item_id, 'empty');

                    if(file_exists($unique->Src())) {

                        unlink($unique->Src());
                    }

                    $picture = new Pictures([

                        'alt' => NULL,
                        'src' => NULL,
                        'item_id' => $item_id,
                        'nb_picture' => $unique->Nb_picture(),
                        'picture_name' => $unique->Picture_name()

                    ]);

                    $manager->updateSlider($picture, $module, $post['empty-slider-' . $i]);
                }

            }

        }

        // if user change media then upate all slides and delete all files associated  

        else {

            $manager = $this->managers->getManagerOf('Pictures');
            $many = $manager->getPicturesSlider($item_id, $module, 'backend');

            foreach($many as $deleteMany) {

                if(file_exists($deleteMany->Src())) {

                    unlink($deleteMany->Src());
                }

                $picture = new Pictures([

                    'alt' => NULL,
                    'src' => NULL,
                    'item_id' => $item_id,
                    'nb_picture' => $deleteMany->Nb_picture(),
                    'picture_name' => $deleteMany->Picture_name()

                ]);

                $manager->updateSlider($picture, $module, $deleteMany->getId());

            }

        }
        
    }

    // show main picture in admin 

    public function getMain($module, $item_id) {

        $manager = $this->managers->getManagerOf('Pictures');
        $unique = $manager->getUnique($module, $item_id);
        return $unique;
    }

    // delete main picture when page is deleted 

    public function deletePictureWithPage($module, $item_id) {

        $manager = $this->managers->getManagerOf('Pictures');
        $unique = $manager->getUnique($module, $item_id);

            if(isset($unique) && file_exists($unique->Src())) {

                unlink($unique->Src());

            }

        $manager->deleteMain($item_id, $module);

    }

    // delete main picture when page is deleted 

    public function deleteSliderWithPage($module, $item_id) {

        $manager = $this->managers->getManagerOf('Pictures');
        $many = $manager->getPicturesSlider($item_id, $module, 'backend');

        foreach($many as $delete) {

            if(file_exists($delete->Src())) {

                unlink($delete->Src());

            }

            $manager->deleteSlider($delete->getId(), $module);
        }
    }
}