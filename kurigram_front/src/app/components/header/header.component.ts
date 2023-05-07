import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  constructor(private request: RequestService) {}

  isLoggedIn = false;

  get currentUser() {
    return this.request.getCurrentUser();
  }
  login() {
    // logic to log in the user
    this.isLoggedIn = true;
  }

  // método para cerrar sesión
  logout() {
    // lógica para cerrar sesión
    this.isLoggedIn = false;
  }
}
