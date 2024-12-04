<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            color: #00695c;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }
        h1, h2 {
            color: #004d40;
        }
        .question {
            margin-bottom: 20px;
            text-align: left;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #004d40;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #00796b;
            border-radius: 4px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
<?php
$questions = [
    [
        'type' => 'multiple-choice',
        'question' => 'Apa warna langit pada siang hari?',
        'options' => ['Merah', 'Biru', 'Hijau', 'Kuning'],
        'answer' => 'Biru',
        'points' => 5
    ],
    [
        'type' => 'fill-in-the-blank',
        'question' => 'Siapa presiden pertama Republik Indonesia?',
        'answer' => 'Soekarno',
        'points' => 5
    ],
    [
        'type' => 'multiple-choice',
        'question' => 'Apa ibukota Indonesia?',
        'options' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan'],
        'answer' => 'Jakarta',
        'points' => 5
    ],
    [
        'type' => 'fill-in-the-blank',
        'question' => 'Sebutkan satu jenis hewan mamalia!',
        'answer' => 'Kucing',
        'points' => 5
    ],
    [
        'type' => 'multiple-choice',
        'question' => 'Apa satuan waktu?',
        'options' => ['Detik', 'Menit', 'Jam', 'Hari'],
        'answer' => 'Detik',
        'points' => 5
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerName = $_POST['playerName'] ?? '';
    $playerNIM = $_POST['playerNIM'] ?? '';
    $answers = $_POST['answers'] ?? [];
    $score = 0;

    foreach ($questions as $index => $question) {
        if (isset($answers[$index]) && strtolower(trim($answers[$index])) === strtolower($question['answer'])) {
            $score += $question['points'];
        }
    }
    ?>
    <h1>Hasil Kuis</h1>
    <p><strong>Nama:</strong> <?= htmlspecialchars($playerName) ?></p>
    <p><strong>NIM:</strong> <?= htmlspecialchars($playerNIM) ?></p>
    <p><strong>Nilai Total:</strong> <?= $score ?></p>
    <a href="quiz.php" class="button">Kembali ke Beranda</a>
    <?php
    exit;
}
?>

<h1>Selamat Datang di Kuis</h1>
<p>Silakan isi data Anda untuk memulai kuis</p>
<form method="post" action="">
    <input type="text" name="playerName" placeholder="Nama" required>
    <input type="text" name="playerNIM" placeholder="NIM" required>

    <?php foreach ($questions as $index => $question): ?>
        <div class="question">
            <p><strong><?= ($index + 1) . ". " . htmlspecialchars($question['question']) ?></strong></p>
            <?php if ($question['type'] === 'multiple-choice'): ?>
                <?php foreach ($question['options'] as $option): ?>
                    <label>
                        <input type="radio" name="answers[<?= $index ?>]" value="<?= htmlspecialchars($option) ?>">
                        <?= htmlspecialchars($option) ?>
                    </label><br>
                <?php endforeach; ?>
            <?php elseif ($question['type'] === 'fill-in-the-blank'): ?>
                <input type="text" name="answers[<?= $index ?>]" placeholder="Jawaban">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <button type="submit" class="button">Kumpulkan Jawaban</button>
</form>
</div>
</body>
</html>