<?php
require('../../settings.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateManga'])) {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Trim and sanitize input
    $id = trim($_POST['id']);
    $title = trim($_POST['title']);
    $alternative = trim($_POST['alternative']);
    $description = trim($_POST['description']);
    $score = trim($_POST['score']);
    $year = trim($_POST['year']);
    $type = trim($_POST['type']);
    $calendar = trim($_POST['calendar']);
    $artist = trim($_POST['artist']);
    $author = trim($_POST['author']);
    $status = trim($_POST['status']);
    $hash = trim($_POST['hash']);
    $adult = trim($_POST['adult']);
    $slug = trim(trtoeng($_POST['slug']));

    // Check genres
    $genre = !empty($_POST['genres']) ? json_encode($_POST['genres'], JSON_UNESCAPED_UNICODE) : '';

    // File uploads
    $cover = $_FILES['cover']['name'];
    $chapter_cover = $_FILES['chapter_cover']['name'];
	$slider_image = $_FILES['slider_image']['name'];
	
    $allowedTypes = array("image/jpeg", "image/jpg", "image/png", "image/webp", "image/gif");
    $folder_path =  '../../uploads/' . $hash . '/';
    $folder_path_cover = $folder_path . 'cover/';
    $folder_path_chapters = $folder_path . 'chapters/';

    // Create folders if they don't exist
    if (!file_exists($folder_path)) mkdir($folder_path, 0755, true);
    if (!file_exists($folder_path_cover)) mkdir($folder_path_cover, 0755, true);
    if (!file_exists($folder_path_chapters)) mkdir($folder_path_chapters, 0755, true);

    // Handle cover upload
    if (isset($_FILES['cover']['name']) && is_uploaded_file($_FILES['cover']['tmp_name'])) {
        $cover_tmp = $_FILES['cover']['tmp_name'];
        $cover = uniqid().$cover;
        $file_path = $folder_path_cover . $cover;
        if (move_uploaded_file($cover_tmp, $file_path)) {
            echo "Cover file is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible cover file upload attack!\n";
        }
    } else {
        $cover = $_POST['cover_name'];
    }

    // Handle chapter cover upload
    if (isset($_FILES['chapter_cover']['name']) && is_uploaded_file($_FILES['chapter_cover']['tmp_name'])) {
        $chapter_cover_tmp = $_FILES['chapter_cover']['tmp_name'];
        $chapter_cover = uniqid().$chapter_cover;
        $file_path = $folder_path_cover . $chapter_cover;
        if (in_array($_FILES['chapter_cover']['type'], $allowedTypes)) {
            if (move_uploaded_file($chapter_cover_tmp, $file_path)) {
                echo "Chapter cover file is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible chapter cover file upload attack!\n";
            }
        } else {
            echo "Invalid chapter cover file type!\n";
        }
    } else {
        $chapter_cover = trim($_POST['chapter_cover_name']);
    }
	
	    // Handle Slider Image upload
    if (isset($_FILES['slider_image']['name']) && is_uploaded_file($_FILES['slider_image']['tmp_name'])) {
        $slider_image_tmp = $_FILES['slider_image']['tmp_name'];
        $slider_image = uniqid().$slider_image;
        $file_path = $folder_path_cover . $slider_image;
        if (in_array($_FILES['slider_image']['type'], $allowedTypes)) {
            if (move_uploaded_file($slider_image_tmp, $file_path)) {
                echo "slider image file is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible slider image file upload attack!\n";
            }
        } else {
            echo "Invalid slider image file type!\n";
        }
    } else {
        $slider_image = trim($_POST['slider_image_name']);
    }

    // Insert data to database using prepared statements
    $stmt = $connection->prepare("UPDATE manga SET 
        `title` = ?, `alternative_title` = ?, `slug` = ?, `description` = ?, 
        `score` = ?, `cover` = ?, `chapter_cover` = ?, `slider_image` = ?, `genres` = ?, 
        `artist` = ?, `author` = ?, `year` = ?, `status` = ?, `type` = ?, `calendar` = ? , adult = ?
        WHERE `id` = ?");
    $stmt->bind_param("ssssssssssssssssi", $title, $alternative, $slug, $description, $score, 
        $cover, $chapter_cover, $slider_image, $genre, $artist, $author, $year, $status, $type, $calendar,$adult, $id);

    if ($stmt->execute()) {
		$_SESSION['message'] = "Veriler başarıyla eklendi.";
         header('Location: ../single.php?id=' . $id);
         exit;
    } else {
        $_SESSION['message'] = "Sorgu çalıştırma hatası: " . $stmt->error;
         header('Location: ../single.php?id=' . $id);
       	 exit;
    }
}
?>
