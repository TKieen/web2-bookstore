<?php
if (isset($_POST['product_id'])) {
  $productId = $_POST['product_id'];
  $conn = connectDB();
  $query = "SELECT 
    p.name product_name, 
    p.image_path, 
    p.quantity, 
    p.price, 
    pub.name publisher_name,
    (
      SELECT GROUP_CONCAT(c.name)
      FROM category_details cd
        INNER JOIN categories c ON cd.category_id = c.id
      WHERE cd.product_id = p.id
    ) category_names,
    (
      SELECT GROUP_CONCAT(a.name)
      FROM author_details ad
        INNER JOIN authors a ON ad.author_id = a.id
      WHERE ad.product_id = p.id
    ) author_names
    FROM products p  
      INNER JOIN publishers pub ON p.publisher_id = pub.id
    WHERE p.id = $productId
    GROUP BY p.id";

  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
  }
  mysqli_close($conn);
}
