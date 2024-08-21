<?php
include '../../connection.php';

// Pagination variables
$limit = 6; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query to fetch announcements for the current page
$sql = "SELECT date_posted, title, description, file_name FROM announcements LIMIT $start, $limit";
$result = $conn->query($sql);

// Query to fetch total number of announcements
$count_sql = "SELECT COUNT(*) AS total FROM announcements";
$count_result = $conn->query($count_sql);
$total_announcements = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_announcements / $limit);

// Generate table rows
$rows = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows .= "<tr class='border-b hover:bg-gray-100'>";
        $rows .= "<td class='px-4 py-2'>" . htmlspecialchars($row["date_posted"]) . "</td>";
        $rows .= "<td class='px-4 py-2'>" . htmlspecialchars($row["title"]) . "</td>";
        $rows .= "<td class='px-4 py-2'>" . htmlspecialchars($row["description"]) . "</td>";
        $rows .= "<td class='px-4 py-2'>";
        if (!empty($row['file_name'])) {
            $rows .= '<a href="../../Announcements/' . htmlspecialchars($row['file_name']) . '" class="text-blue-600 hover:underline" target="_blank">View File</a>';
        } else {
            $rows .= "No File";
        }
        $rows .= "</td>";
        $rows .= "</tr>";
    }
} else {
    $rows = "<tr><td colspan='4' class='px-4 py-2 text-center'>No announcements found</td></tr>";
}

// Generate pagination links
$pagination = '';
if ($total_pages > 1) {
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? 'bg-blue-700' : 'bg-blue-600';
        $pagination .= '<a class="px-4 py-2 mx-1 text-white rounded ' . $active . '" href="#" data-page="' . $i . '">' . $i . '</a>';
    }
}

// Return JSON response
echo json_encode([
    'rows' => $rows,
    'pagination' => $pagination
]);
?>