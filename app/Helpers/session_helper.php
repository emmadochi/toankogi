<?php
// Set session security and persistence parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Lax');

if (session_status() === PHP_SESSION_NONE) {
    if (!session_start()) {
        error_log("CRITICAL: Failed to start session.");
    }
}

/**
 * Check if the user is logged in
 *
 * @return boolean
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if a member is logged in
 *
 * @return boolean
 */
function isMemberLoggedIn() {
    return isset($_SESSION['member_id']);
}

/**
 * Flash message helper
 *
 * @param string $name
 * @param string $message
 * @param string $class
 * @return void
 */
function flash($name = '', $message = '', $class = 'success') {
    if(!empty($name)) {
        if(!empty($message) && empty($_SESSION[$name])) {
            if(!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            // Map common alert classes to SweetAlert icons (success, error, warning, info)
            $icon = 'success';
            if(strpos($class, 'danger') !== false) $icon = 'error';
            elseif(strpos($class, 'warning') !== false) $icon = 'warning';
            elseif(strpos($class, 'info') !== false) $icon = 'info';
            
            $_SESSION[$name . '_class'] = $icon;
        } elseif(empty($message) && !empty($_SESSION[$name])) {
            $icon = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'success';
            echo '<div class="swal-flash" data-message="'.$_SESSION[$name].'" data-icon="'.$icon.'"></div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}


/**
 * Redirect helper
 *
 * @param string $page
 * @return void
 */
function redirect($page) {
    header('location: ' . URLROOT . '/' . $page);
    exit;
}

/**
 * Generate CSRF Token
 *
 * @return string
 */
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF Token
 *
 * @param string $token
 * @return boolean
 */
function validate_csrf($token) {
    if (!empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
        return true;
    }
    return false;
}
