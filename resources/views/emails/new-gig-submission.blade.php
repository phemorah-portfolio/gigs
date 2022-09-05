<p>A new Gig has been created:</p>
<table>
    <tr>
        <td>ID</td>
        <td>{{ $listing->id }}</td>
    </tr>
    <tr>
        <td>Gig Role</td>
        <td>{{ $listing->title }}</td>
    </tr>
    <tr>
        <td>Company Email</td>
        <td>{{ $listing->user->email }}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td>{{ $listing->description }}</td>
    </tr>
    <tr>
        <td>Submitted At</td>
        <td>{{ $listing->created_at }}</td>
    </tr>
</table>
<style>
    table, td, th {
        border: 1px solid #ddd;
        text-align: left;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 15px;
        text-align: left;
    }
</style>