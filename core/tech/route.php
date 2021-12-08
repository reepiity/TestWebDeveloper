<?PHP 
    if (! isset($_GET['page']))
    {
        $halaman="./resep/listResep.php";
    }
    else
    {   
        switch($_GET["page"])
        {         
            // dashboard
            case "AR":
                $halaman="./resep/addResep.php";               
            break;

        }
    }
    include("$halaman");
?>