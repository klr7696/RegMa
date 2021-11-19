import React, { useState } from "react";
import ReactDOM from "react-dom";
import { HashRouter, Route, Switch, Redirect } from "react-router-dom";
import AppAdmin from "./Admin/AppAdmin";
import AppAuth from "./Authent/AppAuth";
import Load from "./Load";
import AppSbu from "./Sbu/AppSbu";
import AppSco from "./Sco/AppSco";
import AppScp from "./Scp/AppScp";
import AppSde from "./Sde/AppSde";
import { ToastContainer} from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import Login from "./Authent/pages/login";
import AuthAPI from "./zservices/authAPI";

AuthAPI.setup();

const PrivateRoute = ({path, isAuthenticated, component}) => {
isAuthenticated ? (<Route path={path}
component={component}/>
):(
  <Redirect to="/login" />
)
}

const App = () => {

  const [isAuthenticated, setIsAuthenticated] = useState(false);

  return (
      <> 
    <Load/> 
    
  <HashRouter>
    
       <Switch>
         
         <Route path="/login" render={props => (
           <Login
           onLogin={setIsAuthenticated}
           />
         )}/>    
          <PrivateRoute 
          path="/admin" 
          component={AppAdmin}
         // isAuthenticated={isAuthenticated}
          />
          <Route path="/sbu" component={AppSbu} />
          <Route path="/scp" component={AppScp}/>
          <Route path="/sco" component={AppSco}/>
          <Route path="/sde" component={AppSde}/>
          <Route component={AppAuth}/>
        </Switch>
  </HashRouter>
  <ToastContainer/>
  </>
  );
  };

const routeElement = document.querySelector("#app");
ReactDOM.render(<App />, routeElement);
