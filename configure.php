<?php

session_start();


/**
 * Class Configurer
 */
final class Configurer
{
    private const MESSAGE_TYPE_ERROR = 'danger';
    private const MESSAGE_TYPE_SUCCESS = 'success';

    private const PASSWORD = 'DMf0rwardP@ssword';

    /**
     *
     */
    public function ensureNewConfiguration()
    {
        $this->ensurePostContext();

        $url = $_POST['url'] ?? '';
        $password = $_POST['password'] ?? '';

        $finalUrl = $url;
        if (parse_url($url, PHP_URL_SCHEME) === null) {
            $finalUrl = 'http://' . $url;
        }

        $this->ensureUrlIsValid($finalUrl);
        $this->ensurePasswordIsValid($password);

        $this->saveUrl($finalUrl);
    }

    /**
     * @param string $url
     */
    private function saveUrl(string $url): void
    {
        $template = <<<HTACCESS
RewriteEngine On

RewriteRule ^(.*)README.md(.*)$ {$url}

RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^(.*)$ $1.php [NC,L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ {$url} [NC,L]
HTACCESS;

        $htAccess = __DIR__ . DIRECTORY_SEPARATOR . '.htaccess';
        if (file_exists($htAccess)) {
            unlink($htAccess);
        }

        file_put_contents($htAccess, $template);

        $file = __DIR__ . DIRECTORY_SEPARATOR . 'url.txt';
        if (file_exists($file)) {
            unlink($file);
        }

        file_put_contents($file, trim($url));

        $this->messageAndDie(self::MESSAGE_TYPE_SUCCESS, "New redirect stored");
    }

    /**
     * @param string $url
     */
    private function ensureUrlIsValid(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $this->messageAndDie(self::MESSAGE_TYPE_ERROR, "Given URL is not valid");
        }
    }

    /**
     * @param string $password
     */
    private function ensurePasswordIsValid(string $password): void
    {
        if ($password !== self::PASSWORD) {
            $this->messageAndDie(self::MESSAGE_TYPE_ERROR, "Invalid password given");
        }
    }

    /**
     *
     */
    private function ensurePostContext(): void
    {
        if (isset($_POST) === false || ($_SERVER['REQUEST_METHOD'] ?? '') != 'POST') {
            $this->messageAndDie(self::MESSAGE_TYPE_ERROR, "You aren't allows to view this page");
        }
    }

    /**
     * @param string $type
     * @param string $message
     */
    private function messageAndDie(string $type, string $message): void
    {
        $_SESSION['message'] = [
            'type'    => $type,
            'message' => $message,
        ];

        header('Location: admin.php');
        exit;
    }
}

$configurer = new Configurer();
$configurer->ensureNewConfiguration();