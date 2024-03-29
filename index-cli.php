<?php
require_once("./src/snapchat.php");
// Log in:
$snapchat = new Snapchat('username', 'password');
$snaps = $snapchat->getSnaps();
$files = glob('./archive'. '/*.*');
$ext=".jpeg";
$type=Snapchat::MEDIA_IMAGE;

// Cycle through received snaps
foreach ($snaps as $snap)
{
		// get snap file and save it
		$data = $snapchat->getMedia($snap->id);

		// get first blob bytes
                $head = substr($data, 0, 2);
                // Check for a JPG header.
                if ($head[0] == chr(0xFF) && $head[1] == chr(0xD8)) {
			$ext=".jpg";
                }
                // Check for a MP4 header.
                if ($head[0] == chr(0x00) && $head[1] == chr(0x00)) {
                        echo "mp4";
			$ext=".mp4";
                }

		$filename='./archive/'.$snap->sender.'-'.$snap->id.$ext;
		file_put_contents($filename, $data);
		$snapchat->markSnapViewed($snap->id); 

		// get a random file from archive
		$file = array_rand($files);

		// find out if selected file is mp4 or jpg
		$res=strpos($files[$file],".jpg");
		if ( $res !== false) {
                        echo "jpg";
 			$type=Snapchat::MEDIA_IMAGE;
		} else {
                        echo "mp4";
 			$type=Snapchat::MEDIA_VIDEO;
		}
		// Snap back to user
		$id = $snapchat->upload($type,file_get_contents($files[$file]));
		$snapchat->send($id, array($snap->sender), 8);
}

// Clear bot feed
$snapchat->clearFeed();


// send random snap to story every 30 mins
$mins=date('i');
if ($mins == '30' || $mins == '00'){

	// purge empty files
        foreach ($files as $file){ 
                if (filesize($file) == '0' ) { unlink ($file); }
        }

	// select a rando file from archive
        $file = array_rand($files);
        // find out if selected file is mp4 or jpg
        $res=strpos($files[$file],".jpg");
        if ( $res !== false) {
               echo "jpg";
               $type=Snapchat::MEDIA_IMAGE;
        } else {
               echo "mp4";
               $type=Snapchat::MEDIA_VIDEO;
        }
	// Send snap to bot story
        $id = $snapchat->upload($type,file_get_contents($files[$file]));
        $snapchat->setStory($id, $type);
}

?>

