<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

// Helper function to format skills
function implodeSkills($skills) {
    return implode(' · ', array_slice($skills, 0, 2)); // Limit skills to two
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart AquaClear | About Us</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../includes/header.php'; ?>

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <?php include '../includes/sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Meet the Development Team</h1>
                    <p class="lead">The minds behind Smart AquaClear</p>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4" id="developersContainer">
                    <?php
                    $devs = [
                        [
                            "name" => "Giovanni P. Encabo",
                            "role" => "Lead Programmer",
                            "emoji" => "🧠",
                            "bio" => "Full-stack developer specializing in system architecture.",
                            "skills" => ["PHP", "Python", "JavaScript"],
                            "contact" => "giovanni.encabo@example.com"
                        ],
                        [
                            "name" => "Clent Ivan Pacilan",
                            "role" => "UI/UX Designer",
                            "emoji" => "🎨",
                            "bio" => "Creative designer focused on user-friendly interfaces.",
                            "skills" => ["Figma", "Adobe XD", "HTML/CSS"],
                            "contact" => "clent@aquaclear.com"
                        ],
                        [
                            "name" => "Arvy Las-eras",
                            "role" => "Database Admin",
                            "emoji" => "💽",
                            "bio" => "Expert in database management and optimization.",
                            "skills" => ["MySQL", "PostgreSQL", "MongoDB"],
                            "contact" => "arvy@aquaclear.com"
                        ],
                    ];

                    foreach ($devs as $index => $dev):
                    ?>
                    <div class="col">
                        <div class="card h-100 developer-card" data-bs-toggle="modal" data-bs-target="#developerModal" data-dev-index="<?= $index ?>">
                            <div class="card-body">
                                <div class="developer-header">
                                    <span class="emoji-display"><?= $dev['emoji'] ?></span>
                                    <h5 class="card-title"><?= htmlspecialchars($dev['name']) ?></h5>
                                </div>
                                <p class="card-text"><?= htmlspecialchars(implodeSkills($dev['skills'])) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Developer Modal -->
                <div class="modal fade" id="developerModal" tabindex="-1" aria-labelledby="developerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content glass-card">
                            <div class="modal-header">
                                <h5 class="modal-title" id="developerModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h3 id="devName"></h3>
                                <div class="emoji-header">
                                    <span class="emoji-display fs-1" id="devEmoji"></span>
                                </div>
                                <p id="devBio"></p>
                                <ul class="list-unstyled" id="devDetails"></ul>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-primary" id="devContact"><i class="fas fa-envelope"></i> Contact</a>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Developer Modal Handler
        document.addEventListener('DOMContentLoaded', () => {
            const developerModal = document.getElementById('developerModal');
            const devs = <?= json_encode($devs); ?>;

            developerModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const index = button.dataset.devIndex;
                const dev = devs[index];

                document.getElementById('devName').textContent = dev.name;
                document.getElementById('devEmoji').textContent = dev.emoji;
                document.getElementById('devBio').textContent = dev.bio;
                document.getElementById('devContact').href = `mailto:${dev.contact}`;

                const detailsList = document.getElementById('devDetails');
                detailsList.innerHTML = `
                    <li><strong>Role:</strong> ${dev.role}</li>
                    <li><strong>Skills:</strong> ${dev.skills.join(', ')}</li>
                    <li><strong>Contact:</strong> ${dev.contact}</li>
                `;
            });
        });
    </script>
</body>
</html>