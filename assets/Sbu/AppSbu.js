import React from "react";
import { Route, Switch, withRouter } from "react-router";
import HeaderSbu from "./components/HeaderSbu";
import SidebarSbu from "./components/SidebarSbu";
import Allocation from "./pages/Allocation";
import CompteFonction from "./pages/CompteFonction";
import InscriBailleur from "./pages/bailleurs/InscriBailleur";
import ConsultBaill from "./pages/bailleurs/ConsultBailleur";
import InscriNomen from "./pages/nomenclature/InscriNomen";
import ConsultNomen from "./pages/nomenclature/ConsultNomen";
import InscriChap from "./pages/comptesNatures/InscriChap";
import InscriArt from "./pages/comptesNatures/InscriArt";
import InscriPara from "./pages/comptesNatures/InscriPara";
import ConsultNature from "./pages/comptesNatures/ConsultNature";
import InscriExerc from "./pages/Exercice/InscriExerc";
import ClosExerc from "./pages/Exercice/ClosExerc";
import ModifExerc from "./pages/Exercice/ModifExerc";
import ConsultExerc from "./pages/Exercice/ConsutExerc";
import OuvriExerc from "./pages/Exercice/OuvriExerc";
import InscriRessource from "./pages/previsionDepense/InscriRessource";
import ConsultRessource from "./pages/previsionDepense/ConsultRessource";
import InscriCredit from "./pages/previsionDepense/InscriCredit";

const AppSbu = (props) =>{
    return (
      <div>
        <div id="pcoded" className="pcoded">
          <div className="pcoded-container navbar-wrapper">
            <HeaderSbu />
            <div className="pcoded-main-container">
              <div className="pcoded-wrapper">
                <SidebarSbu />

                <div className="pcoded-content">
                  <div className="pcoded-inner-content">
                    <div className="main-body">
                      <Switch>
                        <Route
                          path={`${props.match.url}/allocation`}
                          component={Allocation}
                        />
                         <Route
                          path={`${props.match.url}/bailleurs/:id`}
                          component={InscriBailleur}
                        />
                        <Route
                          path={`${props.match.url}/bailleurs`}
                          component={ConsultBaill}
                        />
                        <Route
                          path={`${props.match.url}/nomenclatures/:id`}
                          component={InscriNomen}
                        />
                         <Route
                          path={`${props.match.url}/nomenclatures`}
                          component={ConsultNomen}
                        />
                         <Route
                          path={`${props.match.url}/chap/:id`}
                          component={InscriChap}
                        />
                        <Route
                          path={`${props.match.url}/arti/:id`}
                          component={InscriArt}
                        />
                         <Route
                          path={`${props.match.url}/para/:id`}
                          component={InscriPara}
                        />
                        <Route
                          path={`${props.match.url}/compte-nature`}
                          component={ConsultNature}
                        />
                         <Route
                          path={`${props.match.url}/exercice/:id`}
                          component={InscriExerc}
                        />
                         <Route
                          path={`${props.match.url}/exercice`}
                          component={ConsultExerc}
                        />
                         <Route
                          path={`${props.match.url}/modif-exercice/`}
                          component={ModifExerc}
                        />
                         <Route
                          path={`${props.match.url}/clos-exercice`}
                          component={ClosExerc}
                        />
                        <Route
                          path={`${props.match.url}/compte-fonction`}
                          component={CompteFonction}
                        />
                         <Route
                          path={`${props.match.url}/ouvr`}
                          component={OuvriExerc}
                        />
                          <Route
                          path={`${props.match.url}/ressources/:id`}
                          component={InscriRessource}
                        />
                        <Route
                          path={`${props.match.url}/ressources`}
                          component={ConsultRessource}
                        />
                        <Route
                          path={`${props.match.url}/credit-ouvert/:id`}
                          component={InscriCredit}
                        />
                         
                      </Switch>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

export default withRouter(AppSbu);
