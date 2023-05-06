import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { User } from 'src/app/models/user';


@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent {
  constructor(private requestService: RequestService) {}

  user: User;

ngOnInit() {
  const currentUserId = 123; // Reemplaza esto por el identificador del usuario actual en tu aplicación
  this.requestService.getUser(currentUserId).subscribe(user => this.user = user);
}
}