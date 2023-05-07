import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { User } from 'src/app/models/user';
import { AuthService } from 'src/app/services/auth.service.service';

@Component({
  selector: 'app-gente',
  templateUrl: './gente.component.html',
  styleUrls: ['./gente.component.css']
})
export class GenteComponent implements OnInit {
  users: User[] = [];

  constructor(private requestService: RequestService, private authService: AuthService) {}

  ngOnInit() {
    this.getUsers();
  }

  getUsers() {
    this.requestService.getUsers().subscribe(users => {
      this.users = users;
    });
  }

  followUser(id: number) {
    const currentUserId = this.authService.getCurrentUserId();
    if (!currentUserId) {
      // Si el usuario no está autenticado, mostrar un mensaje de error
      console.error('Usuario no autenticado');
      return;
    }
    this.requestService.followUser(currentUserId, id).subscribe(() => {
      // Actualizar la lista de usuarios para reflejar el cambio
      this.getUsers();
    });
  }
  
  unfollowUser(id: number) {
    const currentUserId = this.authService.getCurrentUserId();
    if (!currentUserId) {
      // Si el usuario no está autenticado, mostrar un mensaje de error
      console.error('Usuario no autenticado');
      return;
    }
    this.requestService.unfollowUser(currentUserId, id).subscribe(() => {
      // Actualizar la lista de usuarios para reflejar el cambio
      this.getUsers();
    });
  }
}