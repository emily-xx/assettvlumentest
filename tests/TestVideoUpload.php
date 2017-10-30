<?php
    class TestVideoUpload extends TestCase {
        public function testFailedUpload() {
            $this->json('POST', '/api/v1/uploadvideo', [])
                ->seeJson([
                    'error' => 'invalidFile'
                ]);
        }

        public function testSuccessfulUpload() {
            $path = '/videos/test.mp4';
            $videoFile = new UploadedFile($path, 'test.mp4', filesize($path), 'video/mp4', null, true);

            $this->json('POST', '/api/v1/uploadvideo', ['video' => $videoFile])
                ->seeJson([
                    'mime_type' => 'video/mp4'
                ]);
        }
    }
?>
