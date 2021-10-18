import React from "react";
import ReactDOM from "react-dom";
import { HashRouter, Route, Switch } from "react-router-dom";
import AppAdmin from "./Admin/AppAdmin";
import AppAuth from "./Authent/AppAuth";
import Load from "./Load";
import AppSbu from "./Sbu/AppSbu";
import AppSco from "./Sco/AppSco";
import AppScp from "./Scp/AppScp";

const App = () => {
      return (
      <>
    <Load/>
  <HashRouter>
       <Switch>
          <Route path="/admin" component={AppAdmin}/>
          <Route path="/sbu" component={AppSbu}/>
          <Route path="/scp" component={AppScp}/>
          <Route path="/sco" component={AppSco}/>
          <Route component={AppAuth}/>
        </Switch>
  </HashRouter>
  </>
  );
  };

const routeElement = document.querySelector("#app");
ReactDOM.render(<App />, routeElement);
