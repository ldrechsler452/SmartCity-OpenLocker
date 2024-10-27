import LockerItem from '@/Components/LockerItem';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Locker } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function ShowLocker({ locker }: { locker: Locker }) {
    const user = usePage().props.auth.user;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Lockers
                </h2>
            }
        >
            <Head title="Content" />

            <div className="py-0 sm:py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                <LockerItem lockerItem={locker.content} />
                                <div className="flex justify-end">
                                    {!locker.content.user_id &&
                                        <Link href={`/contents/${locker.content.id}/take`}>
                                            <PrimaryButton disabled={locker.is_open}>
                                                Ausleihen
                                            </PrimaryButton>
                                        </Link>
                                    }
                                    {locker.content.user_id == user.id &&
                                        <Link href={`/contents/${locker.content.id}/return`}>
                                            <PrimaryButton>
                                                Zurückgeben
                                            </PrimaryButton>
                                        </Link>
                                    }
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
