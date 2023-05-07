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
    this.requestService.getCurrentUser().subscribe(currentUser => {
      const currentUserId = currentUser.id;
      this.requestService.getUser(currentUserId).subscribe(user => {
        this.user = user;
        console.log(this.user.id);
      });
    });
  }
   
  

  get hasUser(): boolean {
    return !!this.user;
  }
}