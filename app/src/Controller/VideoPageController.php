<?php

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\SpamProtection\Extension\FormSpamProtectionExtension;

class VideoPageController extends PageController
{
      private static $allowed_actions = [
            'CommentForm'
      ];
      public function CommentForm()
      {
            $form = Form::create(
                  $this,
                  'CommentForm',
                  FieldList::create(
                        TextField::create('Name'),
                        TextareaField::create('Comment')
                  ),
                  FieldList::create(
                        FormAction::create('HandleForm', 'Submit Comment')
                  )
            );
            $form->enableSpamProtection();
            return $form;
      }
      public function HandleForm($data, $form)
      {
            $comment = VideoComment::create();
            $comment->VideoPageID = $this->ID;
            $form->saveInto($comment);
            $comment->write();
            return $this->redirectBack();
      }
}