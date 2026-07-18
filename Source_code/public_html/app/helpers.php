<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

// function saveImage($image, $folder = 'news')
// {
//     $imageName = time() . '_' . $image->getClientOriginalName();
//     $image->storeAs('public/assets/images/' . $folder, $imageName);

//     return $imageName;
// }
// function saveImage($image, $folder = 'news')
// {
//     $imageName = time() . '_' . $image->getClientOriginalName();
//     $image->storeAs('public/assets/images/' . $folder, $imageName);

//     // Get the full URL using the asset() helper function
//     $url = 'storage/assets/images/' . $folder . '/' . $imageName;

//     return $url;
// }

function saveImage($image, $folder = 'news')
{
    $destinationPath = public_path('uploads/images/' . $folder);
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }
    $imageName = time() . '_' . $image->getClientOriginalName();

    $image->move($destinationPath, $imageName);
    $url = 'public/uploads/images/' . $folder . '/' . $imageName;

    return $url;
}

function apiResponse($success, $msg, $data, $httpStatusCode=null, $meta=null){
    $response = [
        'success' => $success,
        'msg' => $msg,
        'data' => $data
    ];
    if($meta){
        $response['meta'] = $meta;
    }
    return response()->json($response, $httpStatusCode ? $httpStatusCode : 200);
}

function serviceResponse($success, $msg, $data, $httpStatusCode=null, bool $isMeta=false){
    $response = [
        'success' => $success,
        'msg' => $msg,
        'data' => $isMeta ? $data->toArray()['data'] : $data,
        'statusCode' => $httpStatusCode
        // 'meta' => $meta
    ];
    if($isMeta){
        $response['meta'] = ['current_page' => $data->toArray()['current_page'], 'limit' => $data->toArray()['to'], 'total' => $data->toArray()['total']];
    }
    return $response;
}

function removePublicSegment($imageUrl)
{
    return str_replace('public/', '', $imageUrl);
}
