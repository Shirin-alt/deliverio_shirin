<form method="post" action="/students/update/<?= $student['id']; ?>">
  <input type="text" name="first_name" value="<?= $student['first_name']; ?>" required>
  <input type="text" name="last_name"  value="<?= $student['last_name']; ?>" required>
  <input type="email" name="email"     value="<?= $student['email']; ?>" required>
  <button type="submit">Update</button>
</form>
