import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post';

@Component({
  selector: 'app-post-form',
  template: ``,
})
export class PostFormComponent implements OnInit {

  postForm = new FormGroup({
    title: new FormControl('', Validators.required),
    text: new FormControl('', Validators.required),
    image: new FormControl(''),
    id_user: new FormControl('', Validators.required)
  });

  constructor(private requestService: RequestService) { }

  ngOnInit(): void {
  }

  onSubmit(): void {
    const text = this.postForm.get('text')!.value || '';
    const file = this.postForm.get('image')!.value || '';
    const id_user = this.postForm.get('id_user')!.value || '';
    const title = this.postForm.get('title')!.value || '';
    
    const newPost: Post = {
      _id: '',
      text: text,
      file: file,
      created_at: new Date().toISOString(),
      user: id_user,
      likes: 0,
      isSubmitted: 1,
      title: title
    };
    
    this.requestService.insertPost(newPost)
      .subscribe(
        res => {
          console.log(res);
          this.postForm.reset();
        },
        error => {
          console.log(error);
        }
      );
  }
}

  
  
  
  
  