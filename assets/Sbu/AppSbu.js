import React from "react";
import { Route, Switch, withRouter } from "react-router";
import HeaderSbu from "./components/HeaderSbu";
import SidebarSbu from "./components/SidebarSbu";
import Allocation from "./pages/Allocation";
import Bailleur from "./pages/Bailleur";
import CompteFonction from "./pages/CompteFonction";
import CompteNature from "./pages/CompteNature";
import CreditOuvert from "./pages/CreditOuvert";
import Exercice from "./pages/Exercice";
import InscriBailleur from "./pages/InscriBailleur";
import Nomenclature from "./pages/Nomenclature";
import RessourceFi from "./pages/RessourceFi";

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
                          path={`${props.match.url}/exercice`}
                          component={Exercice}
                        />
                        <Route
                          path={`${props.match.url}/financement`}
                          component={RessourceFi}
                        />
                        <Route
                          path={`${props.match.url}/credit-ouvert`}
                          component={CreditOuvert}
                        />
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
                          component={Bailleur}
                        />
                        <Route
                          path={`${props.match.url}/nomenclature`}
                          component={Nomenclature}
                        />
                        <Route
                          path={`${props.match.url}/compte-nature`}
                          component={CompteNature}
                        />
                        <Route
                          path={`${props.match.url}/compte-fonction`}
                          component={CompteFonction}
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
