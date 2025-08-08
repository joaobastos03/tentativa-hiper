

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página em Manutenção</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .maintenance-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
        }

        .maintenance-icon {
            font-size: 60px;
            color: #ed8936;
            margin-bottom: 20px;
        }

        h1 {
            color: #2d3748;
            font-size: 28px;
            margin-bottom: 15px;
        }

        p {
            color: #718096;
            font-size: 16px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .contact-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .contact-info p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4299e1;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #3182ce;
        }

        /* Ícones do Font Awesome */
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css");
    </style>
</head>
<body>
    <div class="container">
        <div class="maintenance-card">
            <div class="maintenance-icon">
                <i class="fas fa-tools"></i>
            </div>
            <h1>Página em Manutenção</h1>
            <p>Estamos trabalhando para melhorar sua experiência. Esta página estará disponível em breve com novas funcionalidades e melhorias.</p>
            <p>Pedimos desculpas pelo inconveniente e agradecemos sua compreensão.</p>
            
            <div class="contact-info">
                <p>Se precisar de assistência, entre em contato conosco:</p>
                <p><i class="fas fa-envelope"></i>uffhiperfluxograma@gmail.com</p>
                <!--<p><i class="fas fa-phone"></i> (11) 1234-5678</p> -->
            </div>
            
            <a href="dashboard.php" class="btn">
                <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
            </a>
        </div>
    </div>
</body>
</html>