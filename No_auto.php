<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No autorizado</title>
    <link rel="stylesheet" href="estilosCSS/estiloCss3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-MpQxxnT68dFb2cDvgPnoDlF4Z1dXnNw0N1eVP/90waovn/6bM95Ib4uXlQo/8jk0WW8i4X6Vvp8eZaj+2H1S8Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card {
        width: 400px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;
    }

    .card i {
        font-size: 50px;
        color: #ff6347;
        margin-bottom: 20px;
    }

    .card h1 {
        margin-bottom: 10px;
        color: #ff6347;
    }

    .card p {
        margin-bottom: 20px;
        color: #333;
    }

    .button {
        background-color: #ff6347;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #ff8c79;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <i class="fas fa-exclamation-triangle"></i>
            <h1>ACCESO DENEGADO</h1>
            <p>Usted no está autorizado para ingresar.</p>
            <form action="index.php" method="post">
                <button type="submit" class="button">Regresar</button>
            </form>
        </div>
    </div>
</body>

</html>