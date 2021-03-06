<?php

namespace Inzaana\Http\Controllers;

use Illuminate\Http\Request as MediaRequest;

use Inzaana\Http\Requests;
use Inzaana\Http\Controllers\Controller;

// import the Intervention Image Manager Class
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

use Auth;
use Storage;
use Inzaana\Media as TemplateMedia;

// IF YOU NEED 
// Imagick: http://stackoverflow.com/questions/26392726/laravel-imagick-not-installed
//          http://stackoverflow.com/questions/7870878/howto-install-imagick-for-php-on-ubuntu-11-10
//          http://refreshless.com/blog/imagick-pecl-imagemagick-windows/ ---> AWESOME!
//          https://www.devside.net/wamp-server/installing-and-using-imagemagick-with-imagick-php-extension-php_imagick-dll-on-wamp
class MediaController extends Controller
{
    //
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 1_51_Home_container_section-2_img-2_b995a302bc6ffe2d463d69f016a78042.jpeg
    // sources:
    // http://stackoverflow.com/questions/30191330/laravel-5-how-to-access-image-uploaded-in-storage-within-view
    // http://image.intervention.io/api/response
    public function image($filename)
    {
        $mediaArchivePath = str_replace('\\', '\\\\', storage_path('app/media-archive/'. Auth::user()->id  .  '/'));
        // return Storage::disk('local')->get('media-archive/'. Auth::user()->id  .  '/' . $filename );
        $manager = new ImageManager();
        return $manager->make($mediaArchivePath  . $filename)->response();
    }

    public function reload($template_id)
    {
        $success = true;
        $template = Auth::user()->templates->find($template_id);
        if(!$template)
        {
            $success = false;
            $message = 'The requested template (' . $template_id . ') not found';
            return $this->responseWithflashError($message);
        }
        $medias = $template->medias;
        if($medias && $medias->count() == 0)
        {
            $success = false;
            $message = 'The requested medias of template (' . $template->saved_name . ') not found';
            return $this->responseWithflashError($message);
        }
        return response()->json(compact('medias', 'success', 'message'));
    }

    public function save(MediaRequest $request)
    {        
        $user_id = "XXX";
        $template_id = "XXX";
        $success = true;

        if(!$request->has('type')) return $this->responseWithflashError('Image type not supported!');
        if(!$request->has('templateId')) return $this->responseWithflashError('Invalid template found!');
        if(!$request->has('image_id')) return $this->responseWithflashError('Invalid image found!');
        if(!$request->has('image_index')) return $this->responseWithflashError('Invalid image index found!');
        if(!$request->has('image_src')) return $this->responseWithflashError('Image src not supported!');
        if(!$request->has('menu_id')) return $this->responseWithflashError('Invalid menu context!');
        if(!$request->has('image')) return $this->responseWithflashError('Image data lost!');

        $user_id = Auth::user()->id;
        $template_id = $request->input('templateId');
        $img_id = $request->input('image_id');
        $img_src = $request->input('image_src');
        $imgIndex = $request->input('image_index');
        $menu_id = $request->input('menu_id');

        $menuTitle = str_slug($menu_id);

        $type = $request->input('type');

        $data = $request->input('image');
        $patterns = '/^data:image\/(png|jpg|jpeg);base64,/';
        $replacements = '';
        $binary = preg_replace($patterns, $replacements, $data);
        $binary = str_replace(' ', '+', $binary);

        // $strImagePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "webbuilder" . DIRECTORY_SEPARATOR . "archive" . DIRECTORY_SEPARATOR;
        $strImageFileName = $user_id . '_' . $template_id . '_' . $menuTitle . '_' . $img_id . '_' . md5($img_id) . '.' . $type;
        // $strFile = $strImagePath . $strImageFileName;

        $hostArchiveDir = "template-medias/";
        
        // $success = file_put_contents($strFile, base64_decode($binary));
        $writtenBytesLengthOrSuccess = Storage::disk('local')->put('media-archive/' . $user_id . '/' . $strImageFileName, base64_decode($binary));
        $success = $writtenBytesLengthOrSuccess > 0;
        if(!$success)
        {
            $message = 'Image (' . $img_src . ') uploaded failure.';
            return $this->responseWithflashError($message, 200);
        }

        // TODO: Now save it to database
        $media = TemplateMedia::create([
            'template_id' => $template_id,
            'user_id' => $user_id,
            'media_name' => $strImageFileName
        ]);
        if(!$media)
        {
            $success = false;
            $message = 'Image (' . $strImageFileName . ') saving failure.';
            return $this->responseWithflashError($message, 200);
        }
        // NOTE: if we don't replace windows directory separator '\' with escaped character '\\'
        // then in client side JSON.parse() will fail to parse json BE CAREFULL!
        $mediaArchivePath = str_replace('\\', '\\\\', storage_path('app/media-archive/'. Auth::user()->id  .  '/'));

        $imageProfile = '{ "image_id" : "' . $img_id
                        . '", "image_type" : "' . $type
                        . '", "image_index" : ' . $imgIndex
                        . ', "src": "' . $img_src
                        . '", "image_name": "' . $strImageFileName
                        . '", "tag_element": "' . $request->input('tagElement')
                        . '", "template_id": "' . $template_id
                        . '", "src_arch": "' . $mediaArchivePath . $strImageFileName
                        . '" }';
        $message = 'Image (' . $img_src . ') uploaded success.';
        return response()->json(compact('imageProfile', 'success', 'message'));
    }

    protected function responseWithflashError($message, $statusCode = 404)
    {
        $success = false;
        flash()->error($message);
        return response()->json(compact('message', 'success'), $statusCode);
    }
}
