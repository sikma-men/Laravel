<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Dropdown</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Gaya dasar navbar */
        .navbar {
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background: linear-gradient(90deg, #1e293b, #0f172a);
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Branding (judul) */
        .navbar-bran h1 {
            font-size: 1.2rem;
            margin: 0;
            font-weight: bold;
            color: #e2e8f0;
            background: linear-gradient(90deg, #e2e8f0, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }

        .navbar-bran h1:hover {
            transform: scale(1.05);
        }

        /* Link navigasi */
        .navbar-links {
            display: flex;
            gap: 20px;
        }

        .navbar-links a {
            text-decoration: none;
            color: #f1f5f9;
            font-size: 0.9rem;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-links a i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .navbar-links a:hover {
            background-color: #334155;
            color: #e2e8f0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-links a:hover i {
            transform: scale(1.2);
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #1e293b;
            min-width: 160px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1001;
        }

        .dropdown-content a {
            color: #f1f5f9;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #334155;
        }

        /* Hover effect for dropdown */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Footer navbar */
        .navbar-footer {
            font-size: 0.8rem;
            color: #94a3b8;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .navbar-footer:hover {
            opacity: 1;
        }

        /* Responsif untuk layar kecil */
        @media screen and (max-width: 768px) {
            .navbar {
                flex-direction: column;
                height: auto;
                padding: 10px;
            }

            .navbar-brand {
                text-align: center;
            }

            .navbar-links {
                flex-direction: column;
                gap: 10px;
            }

            .dropdown-content {
                position: static;
                display: none;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .navbar-footer {
                margin-top: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-bran">
            <h1>PT Jumpshot Jaya</h1>
        </div>
        <div class="navbar-links">
            <!-- Dropdown Menu -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-map"></i> Maps
                </a>
                <div class="dropdown-content">
                    <a href="/add-location">
                        <i class="fas fa-plus-circle"></i> Add Map
                    </a>
                    <a href="/view-location">
                        <i class="fas fa-map-marked-alt"></i> View Map
                    </a>
                    <a href="/table-location">
                        <i class="fas fa-table"></i> Table Map
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-user"></i> User Management
                </a>
                <div class="dropdown-content">
                    <a href="/table-supplier">
                        <i class="fas fa-table"></i> Data Supplier</a>
                        <a href="/table-buyer">
                            <i class="fas fa-table"></i> Data Buyer</a>
                </div>
            </div>

        </div>
        <footer>
            <div class="navbar-footer">
                &copy; 2025 Garena Jumpshot
            </div>
        </footer>
    </nav>
</body>

</html>
