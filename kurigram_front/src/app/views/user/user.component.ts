import { Component } from '@angular/core';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent {
  public title :string;
  public url: string;
  public identity;
  public token;
  public next_page;
  public total;
  public page;
  public user :User[];
  public follows;
  public status :string;

  error => {
    let errorMessage = <any>error;
    console.log(errorMessage);

    if(errorMessage != null){
      this.status = "error";
    } 
  }

  public mouseLeave(user_id){
    this.followUserOver = 0;
  }

  public followUser(followed :boolean){
    let follow = new FollowService('',this.identity._id, followed);

    this._followService.addFollow(this.token).subscribe(
      response => {
        if (!response.follow) {
          this.status = "error";
        }else{
          this.status = "success";
          this.follow.push(followed);
        }
      },
      error => {
        let errorMessage = <any>error;
        console.log(errorMessage);
    
        if(errorMessage != null){
          this.status = "error";
        }
      }
    )
  }
}
