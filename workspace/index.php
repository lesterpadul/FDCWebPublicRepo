<?php
// Start the session

require_once "config/init.php";

// Check if the user is an admin or a regular user
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

if (!$isAdmin) {
    include "view_partials/user_header.php";
} else {
	include "view_partials/admin_header.php";
}


// Debugging: Print session values
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (array_key_exists('page', $_GET)) {
    switch ($_GET['page']) {
        case 'register':
            if (isset($_SESSION['is_logged_in'])) {
                include "view_partials/forbidden_logout.php";
            } else {
                include "pages/register.php";
            }
            break;
		
		case 'user_exams':
			if (isset($_SESSION['is_logged_in'])) {
				include "pages/user_exams.php";
			} else {
				include "view_partials/forbidden_login.php";
			}
				break;
		
		case 'user_view_questions':
			if (isset($_SESSION['is_logged_in'])) {
				include "pages/user_view_questions.php";
			} else {
				include "view_partials/forbidden_login.php";
			}
				break;

		case 'submit_answers':
			if (isset($_SESSION['is_logged_in'])) {
				include "pages/submit_answers.php";
			} else {
				include "view_partials/forbidden_login.php";
			}
				break;
		
		case 'user_scores':
			if (isset($_SESSION['is_logged_in'])) {
				include "pages/user_scores.php";
			} else {
				include "view_partials/forbidden_login.php";
			}
				break;

        case 'login':
            if (isset($_SESSION['is_logged_in'])) {
                include "view_partials/forbidden_logout.php";
            } else {
                include "pages/login.php";
            }
            break;

        case 'admin_login':
            if (isset($_SESSION['is_logged_in']) && $isAdmin) {
                include "view_partials/forbidden_logout.php";
            } else {
                include "pages/admin/admin_login.php";
            }
            break;

        case 'logout':
            session_destroy();

            if($isAdmin){
				echo "<script>
                window.location.href = '?page=admin_login&debug_came_from_logout=1';
            </script>";

			} else {
				echo "<script>
                window.location.href = '?page=login&debug_came_from_logout=1';
            </script>";
			}

            break;

        case 'home':
            if (!isset($_SESSION['is_logged_in'])) {
                include "view_partials/forbidden_login.php";
            } else {
                include "pages/home.php";
            }
            break;

        case 'admin_dashboard':
            if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
                // Redirect to admin login
                echo "<script>
                    window.location.href = '?page=admin_login&debug_came_from_logout=1';
                </script>";
            } else {
                include "pages/admin/admin_dashboard.php";
            }
            break;

        case 'add_exam':
            if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
                // Redirect to admin login
                echo "<script>
                    window.location.href = '?page=admin_login&debug_came_from_logout=1';
                </script>";
            } else {
                include "pages/admin/add_exam.php";
            }
            break;

        case 'view_questions':
            if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
                // Redirect to admin login
                echo "<script>
                    window.location.href = '?page=admin_login&debug_came_from_logout=1';
                </script>";
            } else {
                include "pages/admin/view_questions.php";
            }
            break;

        case 'edit_exam':
            if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
                // Redirect to admin login
                echo "<script>
                    window.location.href = '?page=admin_login&debug_came_from_logout=1';
                </script>";
            } else {
                include "pages/admin/edit_exam.php";
            }
            break;
		
		case 'view_questions':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/view_questions.php";
			}
			break;

		case 'add_question':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/add_question.php";
			}
			break;
		
		case 'edit_question':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/edit_question.php";
			}
			break;

		case 'view_choices':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/view_choices.php";
			}
			break;
		
		case 'add_choice':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/add_choice.php";
			}
			break;

		case 'edit_choice':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/edit_choice.php";
			}
			break;

		case 'view_users':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/view_users.php";
			}
			break;
			
		case 'enable_user':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/enable_user.php";
			}
			break;

		case 'disable_user':
			if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
				echo "<script>
					window.location.href = '?page=admin_login&debug_came_from_logout=1';
				</script>";
			} else {
				include "pages/admin/disable_user.php";
			}
			break;

			default:
            if (!isset($_SESSION['is_logged_in']) || !$isAdmin) {
				// Redirect to admin login
                echo "<script>window.location.href = '?page=admin_login';</script>";
            } else {
                echo "<script>window.location.href = '?page=login';</script>";
            }
            break;
    }

} else {
    if (!isset($_SESSION['is_logged_in'])) {
        echo "<script>window.location.href = '?page=login';</script>";
    } elseif ($isAdmin) {
        echo "<script>window.location.href = '?page=admin_dashboard';</script>";
    } else {
        echo "<script>window.location.href = '?page=user_exams';</script>";
    }
}


// Load footer
include "view_partials/footer.php";