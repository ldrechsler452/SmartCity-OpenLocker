import LockerItem from '@/Components/LockerItem';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Locker } from '@/types';
import { Head, Link } from '@inertiajs/react';

export default function ShowLocker({ locker }: { locker: Locker }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Lockers
                </h2>
            }
        >
            <Head title="Content" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                <LockerItem lockerItem={locker.content} />
                                <div className="flex justify-end">
                                    <Link href={`/lockers/${locker.id}/open`}>
                                        <PrimaryButton disabled={locker.is_open}>
                                            Open
                                        </PrimaryButton>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
