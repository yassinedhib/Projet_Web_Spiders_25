<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estyle.css">
    <title>Edit Contact</title>
</head>
<body>
    <h1>Edit Message</h1>
    <form action="?action=edit&id=<?= $contact['id'] ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($contact['NAME']) ?>" maxlength="255" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required><br><br>
        <label for="type">Type:</label>
        <input type="text" name="type" value="<?= htmlspecialchars($contact['TYPE']) ?>"><br><br>
        <label for="message">Message:</label>
        <textarea name="message" required><?= htmlspecialchars($contact['message']) ?></textarea><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
