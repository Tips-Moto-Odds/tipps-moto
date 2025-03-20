<?php

function traverseDirectory($dir, $prefix = '') {
    $skipFolders = ['node_modules', 'vendor', '.git', 'storage', 'bootstrap/cache'];
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $file;

        // Skip ignored folders
        if (is_dir($path) && in_array($file, $skipFolders)) {
            continue;
        }

        // Print file or folder with indentation
        echo $prefix . ($file) . "\n";

        // If it's a directory, recurse into it
        if (is_dir($path)) {
            traverseDirectory($path, $prefix . '  '); // Increase indentation
        }
    }
}

// Start traversal from the root directory
$root = getcwd(); // Gets the current working directory
echo "Project Structure:\n";
traverseDirectory($root);

