<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Users Table</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <?php if($this->session->flashdata('created')) : ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('created'); ?>
                            </div>
                        <?php endif ?>
                        <?php if($this->session->flashdata('updated')) : ?>
                            <div class="alert alert-primary">
                                <?= $this->session->flashdata('updated'); ?>
                            </div>
                        <?php endif ?>
                        <?php if($this->session->flashdata('deleted')) : ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('deleted'); ?>
                            </div>
                        <?php endif ?>
                        <h3>
                            Users Table
                            <a href="<?= base_url('student/add'); ?>" class="btn btn-primary float-right">Add User</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user->id; ?></td>
                                        <td><?= $user->first_name; ?></td>
                                        <td><?= $user->last_name; ?></td>
                                        <td>
                                            <a href="<?= base_url('student/edit/' . $student->id); ?>" class="btn btn-info btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('student/delete/' . $student->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>