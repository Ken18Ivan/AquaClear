<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart AquaClear | Feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../includes/header.php'; ?>

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <?php include '../includes/sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">User Feedback</h1>
                    <p class="lead">Share your experience with us</p>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="glass-card p-4">
                            <form action="../Backend/Api/submit_feedback.php" method="POST">
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Your Feedback</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <div class="rating-stars">
                                        <input type="radio" id="star1" name="rating" value="1" required>
                                        <label for="star1" title="1 star">★</label>
                                        <input type="radio" id="star2" name="rating" value="2">
                                        <label for="star2" title="2 stars">★</label>
                                        <input type="radio" id="star3" name="rating" value="3">
                                        <label for="star3" title="3 stars">★</label>
                                        <input type="radio" id="star4" name="rating" value="4">
                                        <label for="star4" title="4 stars">★</label>
                                        <input type="radio" id="star5" name="rating" value="5">
                                        <label for="star5" title="5 stars">★</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                    <div class="col-md-4">
                        <div class="glass-card p-4">
                            <h4>Recent Feedback</h4>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once '../Backend/config/db.php';
                                    $stmt = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC LIMIT 5");
                                    while ($row = $stmt->fetch()):
                                    ?>
                                    <tr>
                                        <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                                        <td><?= htmlspecialchars($row['subject']) ?></td>
                                        <td><?= str_repeat('★', $row['rating']) ?></td>
                                        <td><span class="badge bg-<?= $row['status'] === 'pending' ? 'warning' : 'success' ?>"><?= ucfirst($row['status']) ?></span></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Star rating interaction
        document.querySelectorAll('.rating-stars label').forEach(star => {
            star.addEventListener('click', e => {
                const rating = e.target.htmlFor.replace('star', '');
                document.querySelectorAll('.rating-stars label').forEach((s, idx) => {
                    s.style.color = idx < rating ? '#ffc107' : '#e4e5e9';
                });
            });
        });
    </script>
</body>
</html>