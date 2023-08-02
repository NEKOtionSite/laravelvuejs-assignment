<?php

namespace App\Observers;


use App\Models\Book;

/**
 * The BookObserver class observes changes in the Book model.
 *
 * This observer class provides event handling for the Book model's lifecycle events.
 * It allows performing specific actions when a book is created, updated, deleted, restored, or force deleted.
 */
class BookObserver
{
    /**
     * Handle the Book "created" event.
     *
     * @param  \App\Models\Book  $book The created Book model instance.
     * @return void
     */
    public function created(Book $book): void
    {
        // Implement custom logic when a new book is created.
        // This method will be executed when a new Book record is added to the database.
    }

    /**
     * Handle the Book "updated" event.
     *
     * @param  \App\Models\Book  $book The updated Book model instance.
     * @return void
     */
    public function updated(Book $book): void
    {
        // Implement custom logic when a book is updated.
        // This method will be executed when an existing Book record is updated in the database.
    }

    /**
     * Handle the Book "deleted" event.
     *
     * @param  \App\Models\Book  $book The deleted Book model instance.
     * @return void
     */
    public function deleted(Book $book): void
    {
        // Perform actions when a book is deleted.
        // This method will be executed when a Book record is deleted from the database.

        if ($book->image) {
            if (file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }
        }
    }


    /**
     * Handle the Book "restored" event.
     *
     * @param  \App\Models\Book  $book The restored Book model instance.
     * @return void
     */
    public function restored(Book $book): void
    {
        // Implement custom logic when a previously soft-deleted book is restored.
        // This method will be executed when a previously soft-deleted Book record is restored.
    }

    /**
     * Handle the Book "force deleted" event.
     *
     * @param  \App\Models\Book  $book The permanently deleted Book model instance.
     * @return void
     */
    public function forceDeleted(Book $book): void
    {
        // Implement custom logic when a book is permanently deleted (force deleted).
        // This method will be executed when a Book record is permanently deleted from the database.
    }
}
