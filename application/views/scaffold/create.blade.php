<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Scaffold Make</h2>
      {{-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> --}}
    </div>

    <div class="row g-3">

      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">Basic Info</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">


            <div class="col-12">
              <label for="table_name" class="form-label">Table Name</label>
              <input type="table_name" class="form-control" id="table_name" placeholder="blog.post">
              <div class="invalid-feedback">
                Please enter a valid table_name address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="attributes" class="form-label">Attributes</label>
              <input type="text" class="form-control" id="attributes" placeholder="title:string" required>
              <div class="invalid-feedback">
                Please enter your shipping attributes.
              </div>
            </div>

            <hr class="my-4">
          	<h4 class="mb-3">Relationships</h4>
            <div class="col-md-6">
              <label for="country" class="form-label">Relationships</label>
              <select class="form-select" id="country" required>
                <option value="">Choose...</option>
                <option value="has_one">One-To-One (has_one)</option>
                <option value="belongs_to ">One-To-One (belongs_to )</option>
                <option value="has_many">One-To-Many (has_many)</option>
                <option value="has_many_and_belongs_to">Many-To-Many (has_many_and_belongs_to)</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>


            <div class="col-md-6">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Timestamps</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Soft Deletes</label>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Make</button>
        </form>
      </div>
    </div>
  </main>
</div>
	


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>