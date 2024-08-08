<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <script defer src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-fluid {
            flex: 1;
        }

        .footer {
            background-color: #483285;
        }

        .nav-link {
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover {
            background-color: #71aaeb;
            color: #000;
        }
    </style>

    <title>Data List</title>

</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center">

            <nav class="navbar" style="background-color: #FFCC25;">
                <div class="container-fluid text-center">
                    <!-- <h4 style="color: #483285;">PHILIPPINE PESO EXCHANGE RATES TABLE - REAL TIME TABLE</h4> -->
                </div>
            </nav>

            <!-- Your content goes here -->
            <div class="card bg-light border-dark-subtle my-4" style="max-width: 80rem;">
                <h5 class="card-header bg-light text-center">
                    Sample API Data List
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($api_response == null) : ?>
                                    <tr>
                                        <td colspan="5">No Available Data</td>
                                    </tr>
                                <?php else : ?>
                                    <?php foreach ($api_response as $item) : ?>
                                        <tr>
                                            <td><?php echo $item['id']; ?></td>
                                            <td><?php echo $item['first_name']; ?></td>
                                            <td><?php echo $item['last_name']; ?></td>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="footer pt-3" style="background-color: #483285;">
        <!-- <p class="text-center text-white">Copyright &copy; 2024 USSC. All rights reserved.</p> -->
    </footer>

</body>

</html>