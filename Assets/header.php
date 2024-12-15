<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar bg-info-subtle border-bottom border-body" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Xept</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvbar"
                aria-controls="canvbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="canvbar" aria-labelledby="canvLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="canvLabel">Xept</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1 p-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sales</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Items
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/xept/Pages/Items/Itmcr.page.php">Items Create</a></li>
                                <li><a class="dropdown-item" href="/xept/Pages/Items/Itmrq.page.php">Items Request</a></li>
                                <li><a class="dropdown-item" href="/xept/Pages/Items/Itmap.page.php">Items Approval</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/xept/Pages/Items/Itmst.page.php">Items Stock</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>