<style>
    .sidebar {
        position: fixed;
        height: 100vh;
        width: 250px;
        top: 0;
        left: 0;
        background: linear-gradient(145deg, #1e293b, #0f172a);
        color: #f1f5f9;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        padding: 0;
    }

    .sidebar h1 {
        font-size: 1.75rem;
        margin: 20px;
        color: #e2e8f0;
        text-align: center;
        font-weight: bold;
        border-bottom: 1px solid #334155;
        padding-bottom: 10px;
    }

    .before {
        text-decoration: none;
        color: #f1f5f9;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #334155;
        padding-left: 30px;
        border-left: 4px solid #e2e8f0;
    }
    .after {
        text-decoration: none;
        color: #f1f5f9;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #334155;
        padding-left: 30px;
        border-left: 4px solid #e2e8f0;
    }

    .sidebar a svg {
        width: 20px;
        height: 20px;
        color: #94a3b8;
        transition: color 0.3s ease;
    }

    .sidebar a:hover svg {
        color: #f1f5f9;
    }
</style>

<div class="sidebar">
    <h1>{{$title}}</h1>
    <a href="/add-location" class="{{ request()->is('add-location') ? 'after' :'before' }}">
        Add Map
    </a>
    <a href="/view-location" class="{{ request()->is('view-location') ? 'after' :'before' }}">
        View Map
    </a>
    <a href="/table-location" class="{{ request()->is('table-location') ? 'after' :'before' }}">
        table Map
    </a>
</div>
