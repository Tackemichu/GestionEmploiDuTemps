<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="tbord.php"><i class="fa fa-dashboard"></i> <span>Tableau de bord</span></a></li>
            <li><a href="index.php"><i class="fa fa-user"></i> <span>Professeurs</span></a></li>
            <li><a href="indexsalle.php"><i class="fa fa-home"></i> <span>Salle</span></a></li>
            <li><a href="indexclasse.php"><i class="fa fa-graduation-cap"></i> <span>Classe</span></a></li>
            <li><a href="indexemploi.php"><i class="fa fa-calendar"></i> <span>Emploi du temps</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    <div class="dropdown">
        <i class="fa fa-lock" aria-hidden="true"></i> &nbsp;<a class="dropdown-item" data-bs-toggle="modal"
            data-bs-target="#exampleModal">Deconnexion</a>
    </div>
</aside>

<div class="modal fade" id="exampleModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>voulez-vous vraiment deconnecter?</p>
            </div>
            <div class="modal-footer" style="color: rgb(66, 56, 56);">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                <a href="deconnection.php">
                    <button class="btn btn-danger" type="button">Oui</button>
                </a>
            </div>
        </div>
    </div>
</div>